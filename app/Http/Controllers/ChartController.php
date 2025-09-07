<?php
namespace App\Http\Controllers;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Services\ChartService;
use Illuminate\Support\Facades\Log;

class ChartController {

    protected $chartService;

    public function __construct(ChartService $chartService)
    {
        $this->chartService = $chartService;
    }


    public function generate_activity()
    {
        try {
            $diabetesRisk = $this->chartService->getDiabetesRisk();
            return $diabetesRisk['value'] . '%';
        } catch (\Exception $e) {
            Log::error('Error generating diabetes risk activity: ' . $e->getMessage());
            return '0%';
        }
    }

    public function generate_chart()
    {
        try {
            $complianceData = $this->chartService->getGlucoseExerciseData();
            
            $chart = new Chart;
            $chart->labels($complianceData['labels'])
                ->dataset('User Compliance (%)', 'line', $complianceData['data'])
                ->options([
                    'backgroundColor' => $complianceData['hasData'] ? 'rgba(75, 192, 192, 0.2)' : 'rgba(200, 200, 200, 0.2)',
                    'borderColor' => $complianceData['hasData'] ? 'rgba(75, 192, 192, 1)' : 'rgba(150, 150, 150, 1)',
                    'fill' => true,
                    'tension' => 0.4,
                ]);

            return $chart;
        } catch (\Exception $e) {
            Log::error('Error generating glucose exercise chart: ' . $e->getMessage());
            
            // Return empty chart as fallback
            $chart = new Chart;
            $chart->labels(['Meal Plan Followed', 'Exercise Done'])
                ->dataset('User Compliance (%)', 'line', [0, 0])
                ->options([
                    'backgroundColor' => 'rgba(200, 200, 200, 0.2)',
                    'borderColor' => 'rgba(150, 150, 150, 1)',
                    'fill' => true,
                    'tension' => 0.4,
                ]);
            
            return $chart;
        }
    }

    public function generate_bmi_chart()
    {
        try {
            $bmiData = $this->chartService->getBmiProgressData();
            
            $chart = new Chart;
            
            if ($bmiData['hasData']) {
                $chart->labels($bmiData['labels'])
                    ->dataset('BMI Progress', 'bar', $bmiData['data'])
                    ->options([
                        'backgroundColor' => 'rgba(16, 185, 129, 0.6)',
                        'borderColor' => 'rgba(16, 185, 129, 1)',
                        'borderWidth' => 2,
                    ]);
            } else {
                // Show empty state
                $chart->labels(['No Data'])
                    ->dataset('BMI Progress', 'bar', [0])
                    ->options([
                        'backgroundColor' => 'rgba(200, 200, 200, 0.4)',
                        'borderColor' => 'rgba(150, 150, 150, 1)',
                        'borderWidth' => 2,
                    ]);
            }
            
            return $chart;
        } catch (\Exception $e) {
            Log::error('Error generating BMI chart: ' . $e->getMessage());
            
            // Return empty chart as fallback
            $chart = new Chart;
            $chart->labels(['No Data'])
                ->dataset('BMI Progress', 'bar', [0])
                ->options([
                    'backgroundColor' => 'rgba(200, 200, 200, 0.4)',
                    'borderColor' => 'rgba(150, 150, 150, 1)',
                    'borderWidth' => 2,
                ]);
            
            return $chart;
        }
    }

    public function generate_heart_rate_chart()
    {
        try {
            $heartRateData = $this->chartService->getHeartRateTrendData();
            
            $chart = new Chart;
            
            if ($heartRateData['hasData']) {
                $chart->labels($heartRateData['labels'])
                    ->dataset('Heart Rate (BPM)', 'line', $heartRateData['data'])
                    ->options([
                        'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                        'borderColor' => 'rgba(59, 130, 246, 1)',
                        'borderWidth' => 3,
                        'fill' => true,
                        'tension' => 0.4,
                        'pointBackgroundColor' => 'rgba(59, 130, 246, 1)',
                        'pointBorderColor' => '#ffffff',
                        'pointBorderWidth' => 2,
                        'pointRadius' => 5,
                    ]);
            } else {
                // Show empty state
                $chart->labels(['No Data'])
                    ->dataset('Heart Rate (BPM)', 'line', [0])
                    ->options([
                        'backgroundColor' => 'rgba(200, 200, 200, 0.1)',
                        'borderColor' => 'rgba(150, 150, 150, 1)',
                        'borderWidth' => 3,
                        'fill' => true,
                        'tension' => 0.4,
                        'pointBackgroundColor' => 'rgba(150, 150, 150, 1)',
                        'pointBorderColor' => '#ffffff',
                        'pointBorderWidth' => 2,
                        'pointRadius' => 5,
                    ]);
            }
            
            return $chart;
        } catch (\Exception $e) {
            Log::error('Error generating heart rate chart: ' . $e->getMessage());
            
            // Return empty chart as fallback
            $chart = new Chart;
            $chart->labels(['No Data'])
                ->dataset('Heart Rate (BPM)', 'line', [0])
                ->options([
                    'backgroundColor' => 'rgba(200, 200, 200, 0.1)',
                    'borderColor' => 'rgba(150, 150, 150, 1)',
                    'borderWidth' => 3,
                    'fill' => true,
                    'tension' => 0.4,
                    'pointBackgroundColor' => 'rgba(150, 150, 150, 1)',
                    'pointBorderColor' => '#ffffff',
                    'pointBorderWidth' => 2,
                    'pointRadius' => 5,
                ]);
            
            return $chart;
        }
    }

    public function generate_medication_chart()
    {
        try {
            $medicationData = $this->chartService->getMedicationAdherenceData();
            
            $chart = new Chart;
            $chart->labels($medicationData['labels'])
                ->dataset('Medication Adherence', 'pie', $medicationData['data'])
                ->options([
                    'backgroundColor' => $medicationData['hasData'] ? [
                        'rgba(16, 185, 129, 0.8)',  // Green for taken
                        'rgba(239, 68, 68, 0.8)',   // Red for missed
                        'rgba(245, 158, 11, 0.8)'   // Orange for pending
                    ] : [
                        'rgba(200, 200, 200, 0.8)',
                        'rgba(180, 180, 180, 0.8)',
                        'rgba(160, 160, 160, 0.8)'
                    ],
                    'borderColor' => $medicationData['hasData'] ? [
                        'rgba(16, 185, 129, 1)',
                        'rgba(239, 68, 68, 1)',
                        'rgba(245, 158, 11, 1)'
                    ] : [
                        'rgba(150, 150, 150, 1)',
                        'rgba(130, 130, 130, 1)',
                        'rgba(110, 110, 110, 1)'
                    ],
                    'borderWidth' => 2,
                ]);

            return $chart;
        } catch (\Exception $e) {
            Log::error('Error generating medication chart: ' . $e->getMessage());
            
            // Return empty chart as fallback
            $chart = new Chart;
            $chart->labels(['No Data', '', ''])
                ->dataset('Medication Adherence', 'pie', [1, 0, 0])
                ->options([
                    'backgroundColor' => [
                        'rgba(200, 200, 200, 0.8)',
                        'rgba(180, 180, 180, 0.8)',
                        'rgba(160, 160, 160, 0.8)'
                    ],
                    'borderColor' => [
                        'rgba(150, 150, 150, 1)',
                        'rgba(130, 130, 130, 1)',
                        'rgba(110, 110, 110, 1)'
                    ],
                    'borderWidth' => 2,
                ]);
            
            return $chart;
        }
    }


}

?>