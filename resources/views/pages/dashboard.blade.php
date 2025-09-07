@extends('shared.layout')
@section('content')
@php
  // Instantiate the chart controller with dependency injection
  $chartService = app(App\Services\ChartService::class);
  $chartController = new App\Http\Controllers\ChartController($chartService);
  
  $result = $chartController->generate_activity();
  $chart = $chartController->generate_chart();
  $bmiChart = $chartController->generate_bmi_chart();
  $heartRateChart = $chartController->generate_heart_rate_chart();
  $medicationChart = $chartController->generate_medication_chart();
  
  // Get additional data for better UX
  $diabetesRiskData = $chartService->getDiabetesRisk();
  $glucoseExerciseData = $chartService->getGlucoseExerciseData();
  $bmiData = $chartService->getBmiProgressData();
  $heartRateData = $chartService->getHeartRateTrendData();
  $medicationData = $chartService->getMedicationAdherenceData();
@endphp
 <div class="dashboard-main-body">

        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Dashboard</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                    <a href="/dashboard" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Dashboard
                    </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Medical</li>
                </ul>
            </div>
        
            <div class="row gy-4">
                <div class="col-xxxl-9">
                    <div class="row gy-4">
                        
                        <!-- Patient Visited by Depertment -->
                        <div class="col-xxl-6">
                            <div class="card h-100">
                                <div class="card-header">
                                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                        <h6 class="mb-2 fw-bold text-lg mb-0">Diabetes Risk Level</h6>
                                        @if(!$diabetesRiskData['hasData'])
                                            <span class="badge bg-warning text-dark">No Data</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body p-24 d-flex align-items-center gap-16">
                                    <div id="diabetesRiskChart"></div>
                                    <ul class="d-flex flex-column gap-12">
                                        <li>
                                            <span class="text-lg">Diabetes Risk Analytics: 
                                                <span class="text-primary-600 fw-semibold">{{$result}}</span>
                                            </span>
                                        </li>
                                        @if(!$diabetesRiskData['hasData'])
                                            <li class="text-muted small">
                                                <i class="fas fa-info-circle me-1"></i>
                                                {{ $diabetesRiskData['message'] }}
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                          <div class="col-xxl-6">
                            <div class="card h-100">
                                <div class="card-header">
                                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                        <h6 class="mb-2 fw-bold text-lg mb-0">Glucose and Exercise Chart</h6>
                                        @if(!$glucoseExerciseData['hasData'])
                                            <span class="badge bg-warning text-dark">No Data</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body p-24">
                                    @if($glucoseExerciseData['hasData'])
                                        {!! $chart->container() !!}
                                    @else
                                        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
                                            <i class="fas fa-chart-line text-muted mb-3" style="font-size: 3rem;"></i>
                                            <p class="text-muted text-center">{{ $glucoseExerciseData['message'] }}</p>
                                            <small class="text-muted">Start tracking your meals and exercises to see your compliance data</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                        
                        <!-- BMI Progress Chart -->
                        <div class="col-xxl-6">
                            <div class="card h-100">
                                <div class="card-header">
                                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                        <h6 class="mb-2 fw-bold text-lg mb-0">BMI Progress</h6>
                                        @if(!$bmiData['hasData'])
                                            <span class="badge bg-warning text-dark">No Data</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body p-24">
                                    @if($bmiData['hasData'])
                                        {!! $bmiChart->container() !!}
                                    @else
                                        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
                                            <i class="fas fa-weight text-muted mb-3" style="font-size: 3rem;"></i>
                                            <p class="text-muted text-center">{{ $bmiData['message'] }}</p>
                                            <small class="text-muted">Add BMI measurements to your health plan to track progress</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Heart Rate Trend Chart -->
                        <div class="col-xxl-6">
                            <div class="card h-100">
                                <div class="card-header">
                                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                        <h6 class="mb-2 fw-bold text-lg mb-0">Heart Rate Trend</h6>
                                        @if(!$heartRateData['hasData'])
                                            <span class="badge bg-warning text-dark">No Data</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body p-24">
                                    @if($heartRateData['hasData'])
                                        {!! $heartRateChart->container() !!}
                                    @else
                                        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
                                            <i class="fas fa-heartbeat text-muted mb-3" style="font-size: 3rem;"></i>
                                            <p class="text-muted text-center">{{ $heartRateData['message'] }}</p>
                                            <small class="text-muted">Add heart rate data to your health plan to see trends</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Medication Adherence Chart -->
                        <div class="col-xxl-6">
                            <div class="card h-100">
                                <div class="card-header">
                                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                        <h6 class="mb-2 fw-bold text-lg mb-0">Medication Adherence</h6>
                                        @if(!$medicationData['hasData'])
                                            <span class="badge bg-warning text-dark">No Data</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body p-24">
                                    @if($medicationData['hasData'])
                                        {!! $medicationChart->container() !!}
                                    @else
                                        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
                                            <i class="fas fa-pills text-muted mb-3" style="font-size: 3rem;"></i>
                                            <p class="text-muted text-center">{{ $medicationData['message'] }}</p>
                                            <small class="text-muted">Track your meal and medication activities to see adherence data</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Patient Visited by Depertment -->
                    </div>
                </div>
        
            </div>
    </div>
        @if($glucoseExerciseData['hasData'])
            {!! $chart->script() !!}
        @endif
        @if($bmiData['hasData'])
            {!! $bmiChart->script() !!}
        @endif
        @if($heartRateData['hasData'])
            {!! $heartRateChart->script() !!}
        @endif
        @if($medicationData['hasData'])
            {!! $medicationChart->script() !!}
        @endif
@endsection

@section('chart-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Diabetes Risk Chart with error handling
    try {
        @php
            $numericResult = $diabetesRiskData['hasData'] ? $diabetesRiskData['value'] : 0;
            $hasData = $diabetesRiskData['hasData'] ? 'true' : 'false';
        @endphp
        
        const diabetesData = {
            series: [{{ $numericResult }}],
            hasData: {{ $hasData }},
            message: "{{ $diabetesRiskData['message'] }}"
        };

        // Validate data before rendering
        const validation = ChartUtils.validateChartData(diabetesData, 'radial');
        
        if (!validation.isValid && !validation.isEmpty) {
            ChartUtils.handleChartError('diabetesRiskChart', { message: validation.error });
            return;
        }

        // Get appropriate colors
        const colors = ChartUtils.getChartColors(diabetesData.hasData, 'primary');
        
        const options = {
            series: diabetesData.series,
            chart: {
                height: 300,
                type: 'radialBar',
                animations: {
                    enabled: diabetesData.hasData,
                    easing: 'easeinout',
                    speed: 800,
                },
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        margin: 15,
                        size: "70%",
                    },
                    dataLabels: {
                        showOn: "always",
                        name: {
                            show: true,
                            fontSize: "18px",
                            color: diabetesData.hasData ? "#333" : "#888",
                            offsetY: -10,
                        },
                        value: {
                            show: true,
                            fontSize: "20px",
                            color: diabetesData.hasData ? "#111" : "#888",
                            offsetY: 10,
                            formatter: function (val) {
                                return ChartUtils.formatHealthMetric(val, 'percentage');
                            }
                        }
                    }
                }
            },
            fill: {
                colors: [colors.primary]
            },
            stroke: {
                lineCap: "round",
            },
            labels: [diabetesData.hasData ? "Diabetes Risk" : "No Data"],
            tooltip: {
                enabled: diabetesData.hasData,
                formatter: function(val) {
                    return `Risk Level: ${ChartUtils.formatHealthMetric(val, 'percentage')}`;
                }
            }
        };

        // Safely render the chart
        const diabetesChart = ChartUtils.safeRenderChart('diabetesRiskChart', options);
        
        // Store chart instance for potential updates
        window.diabetesRiskChart = diabetesChart;

    } catch (error) {
        console.error('Error initializing diabetes risk chart:', error);
        ChartUtils.handleChartError('diabetesRiskChart', error);
    }

    // Add error handling for other charts that might fail to load
    @if($glucoseExerciseData['hasData'])
        // Monitor glucose exercise chart for errors
        setTimeout(() => {
            const glucoseContainer = document.querySelector('#glucose-exercise-chart');
            if (glucoseContainer && !glucoseContainer.querySelector('.apexcharts-canvas')) {
                console.warn('Glucose exercise chart may have failed to load');
            }
        }, 2000);
    @endif

    @if($bmiData['hasData'])
        // Monitor BMI chart for errors
        setTimeout(() => {
            const bmiContainer = document.querySelector('#bmi-chart');
            if (bmiContainer && !bmiContainer.querySelector('.apexcharts-canvas')) {
                console.warn('BMI chart may have failed to load');
            }
        }, 2000);
    @endif

    @if($heartRateData['hasData'])
        // Monitor heart rate chart for errors
        setTimeout(() => {
            const heartRateContainer = document.querySelector('#heart-rate-chart');
            if (heartRateContainer && !heartRateContainer.querySelector('.apexcharts-canvas')) {
                console.warn('Heart rate chart may have failed to load');
            }
        }, 2000);
    @endif

    @if($medicationData['hasData'])
        // Monitor medication chart for errors  
        setTimeout(() => {
            const medicationContainer = document.querySelector('#medication-chart');
            if (medicationContainer && !medicationContainer.querySelector('.apexcharts-canvas')) {
                console.warn('Medication chart may have failed to load');
            }
        }, 2000);
    @endif
});
</script>
@endsection