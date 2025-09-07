<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\ChartService;
use App\Models\HealthPlan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

class ChartServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $chartService;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        $this->chartService = new ChartService();
    }

    public function test_diabetes_risk_with_no_data()
    {
        // Test without authentication
        $result = $this->chartService->getDiabetesRisk();
        
        $this->assertFalse($result['hasData']);
        $this->assertEquals(0, $result['value']);
        $this->assertEquals('No health data available', $result['message']);
    }

    public function test_diabetes_risk_with_authenticated_user_but_no_health_plan()
    {
        Auth::login($this->user);
        
        $result = $this->chartService->getDiabetesRisk();
        
        $this->assertFalse($result['hasData']);
        $this->assertEquals(0, $result['value']);
        $this->assertEquals('No health data available', $result['message']);
    }

    public function test_diabetes_risk_with_valid_health_plan()
    {
        Auth::login($this->user);
        
        // Create a health plan with diabetes risk data
        $healthData = json_encode([
            'diabeties_risk' => '25%',
            'bmi' => 24.5,
            'resting_heart_rate' => 72
        ]);
        
        HealthPlan::create([
            'user_id' => $this->user->id,
            'result' => $healthData
        ]);
        
        $result = $this->chartService->getDiabetesRisk();
        
        $this->assertTrue($result['hasData']);
        $this->assertEquals(25, $result['value']);
        $this->assertEquals('Current diabetes risk assessment', $result['message']);
    }

    public function test_glucose_exercise_data_with_no_data()
    {
        $result = $this->chartService->getGlucoseExerciseData();
        
        $this->assertFalse($result['hasData']);
        $this->assertEquals([0, 0], $result['data']);
        $this->assertEquals(['Meal Plan Followed', 'Exercise Done'], $result['labels']);
    }

    public function test_glucose_exercise_data_with_compliance_data()
    {
        Auth::login($this->user);
        
        // Create health plans with compliance data
        $healthData1 = json_encode([
            'daily_meal_plan' => [
                'breakfast' => ['marked_by_user' => 'yes']
            ],
            'physical_activity' => [
                'aerobic_exercise' => ['marked_by_user' => 'yes']
            ]
        ]);
        
        $healthData2 = json_encode([
            'daily_meal_plan' => [
                'breakfast' => ['marked_by_user' => 'none']
            ],
            'physical_activity' => [
                'aerobic_exercise' => ['marked_by_user' => 'completed']
            ]
        ]);
        
        HealthPlan::create(['user_id' => $this->user->id, 'result' => $healthData1]);
        HealthPlan::create(['user_id' => $this->user->id, 'result' => $healthData2]);
        
        $result = $this->chartService->getGlucoseExerciseData();
        
        $this->assertTrue($result['hasData']);
        $this->assertEquals(50.0, $result['data'][0]); // 1 out of 2 meal plans followed
        $this->assertEquals(100.0, $result['data'][1]); // 2 out of 2 exercises done
    }

    public function test_bmi_progress_data_with_valid_data()
    {
        Auth::login($this->user);
        
        // Create health plans with BMI data
        $healthData1 = json_encode(['bmi' => 25.2]);
        $healthData2 = json_encode(['bmi' => 24.8]);
        $healthData3 = json_encode(['bmi' => 24.5]);
        
        HealthPlan::create(['user_id' => $this->user->id, 'result' => $healthData1]);
        HealthPlan::create(['user_id' => $this->user->id, 'result' => $healthData2]);
        HealthPlan::create(['user_id' => $this->user->id, 'result' => $healthData3]);
        
        $result = $this->chartService->getBmiProgressData();
        
        $this->assertTrue($result['hasData']);
        $this->assertEquals(3, count($result['data']));
        $this->assertEquals([25.2, 24.8, 24.5], $result['data']);
    }

    public function test_heart_rate_trend_data_with_valid_data()
    {
        Auth::login($this->user);
        
        // Create health plans with heart rate data
        $healthData1 = json_encode(['resting_heart_rate' => 72]);
        $healthData2 = json_encode(['resting_heart_rate' => 68]);
        $healthData3 = json_encode(['resting_heart_rate' => 70]);
        
        HealthPlan::create(['user_id' => $this->user->id, 'result' => $healthData1]);
        HealthPlan::create(['user_id' => $this->user->id, 'result' => $healthData2]);
        HealthPlan::create(['user_id' => $this->user->id, 'result' => $healthData3]);
        
        $result = $this->chartService->getHeartRateTrendData();
        
        $this->assertTrue($result['hasData']);
        $this->assertEquals(3, count($result['data']));
        $this->assertEquals([72, 68, 70], $result['data']);
    }

    public function test_medication_adherence_data()
    {
        Auth::login($this->user);
        
        // Create health plans with medication adherence data
        $healthData = json_encode([
            'daily_meal_plan' => [
                'breakfast' => ['marked_by_user' => 'completed'],
                'lunch' => ['marked_by_user' => 'missed'],
                'dinner' => ['marked_by_user' => 'yes']
            ]
        ]);
        
        HealthPlan::create(['user_id' => $this->user->id, 'result' => $healthData]);
        
        $result = $this->chartService->getMedicationAdherenceData();
        
        $this->assertTrue($result['hasData']);
        $this->assertEquals(['Taken', 'Missed', 'Pending'], $result['labels']);
        $this->assertEquals(2, $result['data'][0]); // taken (completed + yes)
        $this->assertEquals(1, $result['data'][1]); // missed
        $this->assertEquals(0, $result['data'][2]); // pending
    }

    public function test_invalid_json_handling()
    {
        Auth::login($this->user);
        
        // Create health plan with invalid JSON
        HealthPlan::create([
            'user_id' => $this->user->id,
            'result' => 'invalid json data'
        ]);
        
        $result = $this->chartService->getDiabetesRisk();
        
        $this->assertFalse($result['hasData']);
        $this->assertEquals('Invalid health plan data', $result['message']);
    }

    public function test_bmi_validation()
    {
        Auth::login($this->user);
        
        // Test with invalid BMI values
        $healthDataInvalid = json_encode(['bmi' => 150]); // Too high
        $healthDataValid = json_encode(['bmi' => 22.5]); // Valid
        
        HealthPlan::create(['user_id' => $this->user->id, 'result' => $healthDataInvalid]);
        HealthPlan::create(['user_id' => $this->user->id, 'result' => $healthDataValid]);
        
        $result = $this->chartService->getBmiProgressData();
        
        $this->assertTrue($result['hasData']);
        $this->assertEquals(1, count($result['data'])); // Only valid BMI should be included
        $this->assertEquals([22.5], $result['data']);
    }

    public function test_heart_rate_validation()
    {
        Auth::login($this->user);
        
        // Test with invalid heart rate values
        $healthDataInvalid = json_encode(['resting_heart_rate' => 300]); // Too high
        $healthDataValid = json_encode(['resting_heart_rate' => 72]); // Valid
        
        HealthPlan::create(['user_id' => $this->user->id, 'result' => $healthDataInvalid]);
        HealthPlan::create(['user_id' => $this->user->id, 'result' => $healthDataValid]);
        
        $result = $this->chartService->getHeartRateTrendData();
        
        $this->assertTrue($result['hasData']);
        $this->assertEquals(1, count($result['data'])); // Only valid heart rate should be included
        $this->assertEquals([72], $result['data']);
    }
}