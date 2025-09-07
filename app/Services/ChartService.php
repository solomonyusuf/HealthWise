<?php

namespace App\Services;

use App\Models\HealthPlan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ChartService
{
    /**
     * Get diabetes risk percentage for the authenticated user
     *
     * @return array
     */
    public function getDiabetesRisk(): array
    {
        try {
            $latestPlan = $this->getLatestHealthPlan();
            
            if (!$latestPlan) {
                return [
                    'value' => 0,
                    'hasData' => false,
                    'message' => 'No health data available'
                ];
            }

            $planData = $this->validateAndParseJson($latestPlan->result);
            
            if (!$planData) {
                return [
                    'value' => 0,
                    'hasData' => false,
                    'message' => 'Invalid health plan data'
                ];
            }

            $risk = $planData->diabeties_risk ?? '0%';
            $numericRisk = $this->extractNumericValue($risk);

            return [
                'value' => $numericRisk,
                'hasData' => true,
                'message' => 'Current diabetes risk assessment'
            ];
        } catch (\Exception $e) {
            Log::error('Error getting diabetes risk: ' . $e->getMessage());
            
            return [
                'value' => 0,
                'hasData' => false,
                'message' => 'Error loading diabetes risk data'
            ];
        }
    }

    /**
     * Get glucose and exercise compliance data
     *
     * @return array
     */
    public function getGlucoseExerciseData(): array
    {
        try {
            $healthPlans = $this->getUserHealthPlans();
            
            if ($healthPlans->isEmpty()) {
                return [
                    'labels' => ['Meal Plan Followed', 'Exercise Done'],
                    'data' => [0, 0],
                    'hasData' => false,
                    'message' => 'No compliance data available'
                ];
            }

            $mealCompliance = 0;
            $exerciseCompliance = 0;
            $validEntries = 0;

            foreach ($healthPlans as $plan) {
                $planData = $this->validateAndParseJson($plan->result);
                
                if (!$planData) {
                    continue;
                }

                $validEntries++;

                // Check meal plan compliance
                if ($this->isTaskCompleted($planData, 'daily_meal_plan.breakfast.marked_by_user')) {
                    $mealCompliance++;
                }

                // Check exercise compliance
                if ($this->isTaskCompleted($planData, 'physical_activity.aerobic_exercise.marked_by_user')) {
                    $exerciseCompliance++;
                }
            }

            if ($validEntries === 0) {
                return [
                    'labels' => ['Meal Plan Followed', 'Exercise Done'],
                    'data' => [0, 0],
                    'hasData' => false,
                    'message' => 'No valid compliance data'
                ];
            }

            $mealPercentage = round(($mealCompliance / $validEntries) * 100, 1);
            $exercisePercentage = round(($exerciseCompliance / $validEntries) * 100, 1);

            return [
                'labels' => ['Meal Plan Followed', 'Exercise Done'],
                'data' => [$mealPercentage, $exercisePercentage],
                'hasData' => true,
                'message' => 'User compliance over time'
            ];
        } catch (\Exception $e) {
            Log::error('Error getting glucose exercise data: ' . $e->getMessage());
            
            return [
                'labels' => ['Meal Plan Followed', 'Exercise Done'],
                'data' => [0, 0],
                'hasData' => false,
                'message' => 'Error loading compliance data'
            ];
        }
    }

    /**
     * Get BMI progress data
     *
     * @return array
     */
    public function getBmiProgressData(): array
    {
        try {
            $healthPlans = $this->getUserHealthPlans(6);
            
            if ($healthPlans->isEmpty()) {
                return [
                    'labels' => [],
                    'data' => [],
                    'hasData' => false,
                    'message' => 'No BMI data available'
                ];
            }

            $labels = [];
            $bmiValues = [];

            foreach ($healthPlans->reverse() as $plan) {
                $planData = $this->validateAndParseJson($plan->result);
                
                if ($planData && isset($planData->bmi)) {
                    $bmi = $this->validateBmi($planData->bmi);
                    if ($bmi !== null) {
                        $bmiValues[] = $bmi;
                        $labels[] = Carbon::parse($plan->created_at)->format('M d');
                    }
                }
            }

            if (empty($bmiValues)) {
                return [
                    'labels' => [],
                    'data' => [],
                    'hasData' => false,
                    'message' => 'No valid BMI measurements found'
                ];
            }

            return [
                'labels' => $labels,
                'data' => $bmiValues,
                'hasData' => true,
                'message' => 'BMI progress over time'
            ];
        } catch (\Exception $e) {
            Log::error('Error getting BMI progress data: ' . $e->getMessage());
            
            return [
                'labels' => [],
                'data' => [],
                'hasData' => false,
                'message' => 'Error loading BMI data'
            ];
        }
    }

    /**
     * Get heart rate trend data
     *
     * @return array
     */
    public function getHeartRateTrendData(): array
    {
        try {
            $healthPlans = $this->getUserHealthPlans(7);
            
            if ($healthPlans->isEmpty()) {
                return [
                    'labels' => [],
                    'data' => [],
                    'hasData' => false,
                    'message' => 'No heart rate data available'
                ];
            }

            $labels = [];
            $heartRates = [];

            foreach ($healthPlans->reverse() as $plan) {
                $planData = $this->validateAndParseJson($plan->result);
                
                if ($planData && isset($planData->resting_heart_rate)) {
                    $heartRate = $this->validateHeartRate($planData->resting_heart_rate);
                    if ($heartRate !== null) {
                        $heartRates[] = $heartRate;
                        $labels[] = Carbon::parse($plan->created_at)->format('M d');
                    }
                }
            }

            if (empty($heartRates)) {
                return [
                    'labels' => [],
                    'data' => [],
                    'hasData' => false,
                    'message' => 'No valid heart rate measurements found'
                ];
            }

            return [
                'labels' => $labels,
                'data' => $heartRates,
                'hasData' => true,
                'message' => 'Heart rate trend over time'
            ];
        } catch (\Exception $e) {
            Log::error('Error getting heart rate trend data: ' . $e->getMessage());
            
            return [
                'labels' => [],
                'data' => [],
                'hasData' => false,
                'message' => 'Error loading heart rate data'
            ];
        }
    }

    /**
     * Get medication adherence data
     *
     * @return array
     */
    public function getMedicationAdherenceData(): array
    {
        try {
            $healthPlans = $this->getUserHealthPlans();
            
            if ($healthPlans->isEmpty()) {
                return [
                    'labels' => ['Taken', 'Missed', 'Pending'],
                    'data' => [0, 0, 0],
                    'hasData' => false,
                    'message' => 'No medication data available'
                ];
            }

            $taken = 0;
            $missed = 0;
            $pending = 0;
            $validEntries = 0;

            foreach ($healthPlans as $plan) {
                $planData = $this->validateAndParseJson($plan->result);
                
                if (!$planData) {
                    continue;
                }

                $validEntries++;

                // Check various medication-related activities
                $activities = [
                    'daily_meal_plan.breakfast.marked_by_user',
                    'daily_meal_plan.lunch.marked_by_user',
                    'daily_meal_plan.dinner.marked_by_user'
                ];

                foreach ($activities as $activity) {
                    $status = $this->getNestedProperty($planData, $activity);
                    
                    if ($status === 'completed' || $status === 'yes') {
                        $taken++;
                    } elseif ($status === 'missed') {
                        $missed++;
                    } elseif ($status === 'none' || $status === null) {
                        $pending++;
                    }
                }
            }

            $total = $taken + $missed + $pending;
            
            if ($total === 0) {
                return [
                    'labels' => ['Taken', 'Missed', 'Pending'],
                    'data' => [0, 0, 0],
                    'hasData' => false,
                    'message' => 'No medication adherence data'
                ];
            }

            return [
                'labels' => ['Taken', 'Missed', 'Pending'],
                'data' => [$taken, $missed, $pending],
                'hasData' => true,
                'message' => 'Medication adherence overview'
            ];
        } catch (\Exception $e) {
            Log::error('Error getting medication adherence data: ' . $e->getMessage());
            
            return [
                'labels' => ['Taken', 'Missed', 'Pending'],
                'data' => [0, 0, 0],
                'hasData' => false,
                'message' => 'Error loading medication data'
            ];
        }
    }

    /**
     * Get the latest health plan for the authenticated user
     */
    private function getLatestHealthPlan(): ?HealthPlan
    {
        if (!Auth::check()) {
            return null;
        }

        return HealthPlan::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->first();
    }

    /**
     * Get user health plans with optional limit
     */
    private function getUserHealthPlans(?int $limit = null): Collection
    {
        if (!Auth::check()) {
            return collect();
        }

        $query = HealthPlan::where('user_id', Auth::id())
            ->orderByDesc('created_at');

        if ($limit) {
            $query->take($limit);
        }

        return $query->get();
    }

    /**
     * Validate and parse JSON data
     */
    private function validateAndParseJson(?string $jsonData): ?object
    {
        if (!$jsonData) {
            return null;
        }

        try {
            $decoded = json_decode($jsonData);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::warning('Invalid JSON in health plan: ' . json_last_error_msg());
                return null;
            }
            
            return $decoded;
        } catch (\Exception $e) {
            Log::error('Error parsing health plan JSON: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Extract numeric value from string (e.g., "25%" -> 25)
     */
    private function extractNumericValue(string $value): int
    {
        $numeric = preg_replace('/[^0-9.]/', '', $value);
        return (int) floatval($numeric);
    }

    /**
     * Check if a nested task is completed
     */
    private function isTaskCompleted(object $data, string $path): bool
    {
        $value = $this->getNestedProperty($data, $path);
        return in_array($value, ['yes', 'completed'], true);
    }

    /**
     * Get nested property value using dot notation
     */
    private function getNestedProperty(object $data, string $path)
    {
        $keys = explode('.', $path);
        $current = $data;

        foreach ($keys as $key) {
            if (!isset($current->$key)) {
                return null;
            }
            $current = $current->$key;
        }

        return $current;
    }

    /**
     * Validate BMI value
     */
    private function validateBmi($bmi): ?float
    {
        $numericBmi = is_string($bmi) ? floatval($bmi) : $bmi;
        
        // Valid BMI range: 10-100
        if (is_numeric($numericBmi) && $numericBmi >= 10 && $numericBmi <= 100) {
            return round($numericBmi, 1);
        }
        
        return null;
    }

    /**
     * Validate heart rate value
     */
    private function validateHeartRate($heartRate): ?int
    {
        $numericHeartRate = is_string($heartRate) ? intval($heartRate) : $heartRate;
        
        // Valid heart rate range: 30-250 BPM
        if (is_numeric($numericHeartRate) && $numericHeartRate >= 30 && $numericHeartRate <= 250) {
            return (int) $numericHeartRate;
        }
        
        return null;
    }
}