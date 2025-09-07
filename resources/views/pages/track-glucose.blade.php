@extends('shared.layout')
@section('content')

 <style>
        :root {
            --primary-color: #10b981;
            --primary-hover: #059669;
            --secondary-color: #f8f9fa;
            --border-color: #dee2e6;
            --focus-color: rgba(16, 185, 129, 0.25);
            --danger-color: #dc3545;
            --text-muted: #6b7280;
            --text-dark: #1f2937;
            --border-radius: 0.5rem;
            --box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .bg-base {
            background-color: var(--secondary-color);
        }
        
        .card {
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }
        
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 1.25rem;
        }
        
        .card-body {
            padding: 1.25rem;
        }
        
        .form-control, .form-select {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            padding: 0.375rem 0.75rem;
            transition: all 0.2s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem var(--focus-color);
            outline: none;
        }
        
        .form-control::placeholder, .form-select::placeholder {
            color: #9ca3af;
            opacity: 1;
        }
        
        .input-group-text {
            border: 1px solid #ced4da;
            padding: 0.375rem 0.75rem;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.75rem 2rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            min-height: 44px;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-1px);
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
            background: transparent;
            padding: 0.75rem 2rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            min-height: 44px;
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }
        
        .text-sm {
            font-size: 0.875rem;
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
        }
        
        .card-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-dark);
        }
        
        .is-invalid {
            border-color: var(--danger-color);
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        }
        
        .text-danger {
            color: var(--danger-color);
        }
        
        .readonly-field {
            background-color: var(--secondary-color);
            cursor: not-allowed;
        }
        
        fieldset {
            border: none;
            margin: 0;
            padding: 0;
        }
        
        legend {
            border: none;
            margin-bottom: 0.5rem;
            padding: 0;
            width: auto;
            font-size: inherit;
        }

        /* Multi-step form specific styles */
        .step-progress {
            background: #f8fafc;
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .progress-bar-container {
            position: relative;
            background: #e5e7eb;
            height: 6px;
            border-radius: 3px;
            margin: 1rem 0;
        }
        
        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-hover));
            border-radius: 3px;
            transition: width 0.3s ease;
        }
        
        .step-indicators {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }
        
        .step-indicator {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            flex: 1;
        }
        
        .step-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            transition: all 0.2s ease;
        }
        
        .step-circle.completed {
            background: var(--primary-color);
            color: white;
        }
        
        .step-circle.active {
            background: var(--primary-color);
            color: white;
            box-shadow: 0 0 0 4px var(--focus-color);
        }
        
        .step-circle.inactive {
            background: #e5e7eb;
            color: var(--text-muted);
        }
        
        .step-label {
            font-size: 0.75rem;
            color: var(--text-muted);
            text-align: center;
            line-height: 1.2;
        }
        
        .step-label.active {
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .form-step {
            display: none;
            opacity: 0;
            transform: translateX(20px);
            transition: all 0.3s ease;
        }
        
        .form-step.active {
            display: block;
            opacity: 1;
            transform: translateX(0);
        }
        
        .step-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-color);
        }
        
        .help-tooltip {
            position: relative;
            display: inline-block;
            margin-left: 0.5rem;
        }
        
        .help-tooltip .tooltip-text {
            visibility: hidden;
            width: 200px;
            background-color: #374151;
            color: #fff;
            text-align: left;
            border-radius: 6px;
            padding: 8px 12px;
            position: absolute;
            z-index: 1000;
            bottom: 125%;
            left: 50%;
            margin-left: -100px;
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 0.75rem;
            line-height: 1.3;
        }
        
        .help-tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }
        
        .validation-message {
            color: var(--danger-color);
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: none;
        }
        
        .validation-message.show {
            display: block;
        }
        
        .skip-section {
            text-align: center;
            margin: 1rem 0;
        }
        
        .skip-link {
            color: var(--text-muted);
            text-decoration: underline;
            cursor: pointer;
            font-size: 0.875rem;
        }
        
        .skip-link:hover {
            color: var(--primary-color);
        }
        
        .summary-section {
            background: #f8fafc;
            border-radius: 0.5rem;
            padding: 1rem;
            margin: 1rem 0;
        }
        
        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .summary-item:last-child {
            border-bottom: none;
        }
        
        .summary-label {
            font-weight: 500;
            color: var(--text-dark);
        }
        
        .summary-value {
            color: var(--text-muted);
        }
        
        .loading-spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s ease-in-out infinite;
            margin-right: 0.5rem;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        @media (max-width: 768px) {
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }
            
            .col-lg-8 {
                padding-left: 0;
                padding-right: 0;
            }
            
            .form-check-label {
                font-size: 0.9rem;
            }
            
            .step-indicators {
                flex-wrap: wrap;
                gap: 0.5rem;
            }
            
            .step-indicator {
                flex: 1 1 30%;
                min-width: 80px;
            }
            
            .step-label {
                font-size: 0.7rem;
            }
            
            .step-navigation {
                position: sticky;
                bottom: 0;
                background: white;
                padding: 1rem;
                margin: 0 -1.25rem -1.25rem;
                box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            }
            
            .btn {
                min-width: 100px;
            }
            
            .help-tooltip .tooltip-text {
                width: 150px;
                margin-left: -75px;
            }
        }
        
        @media (max-width: 576px) {
            .step-indicators {
                display: none;
            }
            
            .step-progress {
                padding: 1rem;
            }
            
            .card-body {
                padding: 1rem;
            }
        }
    </style>
 
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title mb-0">Comprehensive Health Assessment</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <!-- Progress Indicator -->
                        <div class="step-progress">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0" id="stepTitle">Step 1: Basic Profile</h6>
                                <span class="text-sm text-muted" id="stepCounter">1 of 6</span>
                            </div>
                            <div class="progress-bar-container">
                                <div class="progress-bar" id="progressBar" style="width: 16.67%"></div>
                            </div>
                            <div class="step-indicators">
                                <div class="step-indicator">
                                    <div class="step-circle active" id="step-1-circle">1</div>
                                    <div class="step-label active" id="step-1-label">Basic Profile</div>
                                </div>
                                <div class="step-indicator">
                                    <div class="step-circle inactive" id="step-2-circle">2</div>
                                    <div class="step-label" id="step-2-label">Body Measurements</div>
                                </div>
                                <div class="step-indicator">
                                    <div class="step-circle inactive" id="step-3-circle">3</div>
                                    <div class="step-label" id="step-3-label">Health Vitals</div>
                                </div>
                                <div class="step-indicator">
                                    <div class="step-circle inactive" id="step-4-circle">4</div>
                                    <div class="step-label" id="step-4-label">Activity & Lifestyle</div>
                                </div>
                                <div class="step-indicator">
                                    <div class="step-circle inactive" id="step-5-circle">5</div>
                                    <div class="step-label" id="step-5-label">Medical History</div>
                                </div>
                                <div class="step-indicator">
                                    <div class="step-circle inactive" id="step-6-circle">6</div>
                                    <div class="step-label" id="step-6-label">Contact & Review</div>
                                </div>
                            </div>
                        </div>
                        
                        <form action="{{ route('ai_result') }}" method="post" id="healthAssessmentForm" novalidate>
        @csrf

        <!-- Step 1: Basic Profile -->
        <div class="form-step active" id="step1" data-step="1">
            <div class="row gy-3">
                <div class="col-12">
                    <h5 class="mb-3">Basic Profile Information</h5>
                    <p class="text-muted mb-4">Let's start with your basic information. This helps us calculate your BMI automatically.</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="age">Age (years) <span class="text-danger">*</span></label>
                    <input type="number" name="age" id="age" class="form-control" placeholder="35" min="1" max="120" required aria-describedby="age-help">
                    <div class="validation-message" id="age-error">Please enter a valid age between 1 and 120 years.</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="height">Height (cm) <span class="text-danger">*</span>
                        <span class="help-tooltip">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                            <span class="tooltip-text">Measure your height without shoes, standing straight against a wall</span>
                        </span>
                    </label>
                    <input type="number" name="height" id="height" class="form-control" placeholder="170" min="50" max="250" required aria-describedby="height-help">
                    <div class="validation-message" id="height-error">Please enter a valid height between 50 and 250 cm.</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="weight">Weight (kg) <span class="text-danger">*</span>
                        <span class="help-tooltip">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                            <span class="tooltip-text">Weigh yourself in the morning without clothes for most accurate reading</span>
                        </span>
                    </label>
                    <input type="number" name="weight" id="weight" class="form-control" placeholder="70" min="20" max="300" step="0.1" required aria-describedby="weight-help">
                    <div class="validation-message" id="weight-error">Please enter a valid weight between 20 and 300 kg.</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="bmi">BMI (kg/m²)</label>
                    <input type="number" name="bmi" id="bmi" class="form-control readonly-field" placeholder="Auto-calculated" step="0.1" readonly aria-describedby="bmi-help">
                    <small class="text-muted">Calculated automatically based on height and weight</small>
                </div>
                <div class="col-12">
                    <fieldset>
                        <legend class="form-label">Gender <span class="text-danger">*</span></legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="male" id="genderMale" required>
                                    <label class="form-check-label px-4" for="genderMale">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="female" id="genderFemale" required>
                                    <label class="form-check-label px-4" for="genderFemale">Female</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="other" id="genderOther" required>
                                    <label class="form-check-label px-4" for="genderOther">Other</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="prefer-not-to-say" id="genderNA" required>
                                    <label class="form-check-label px-4" for="genderNA">Prefer not to say</label>
                                </div>
                            </div>
                        </div>
                        <div class="validation-message" id="gender-error">Please select your gender.</div>
                    </fieldset>
                </div>
            </div>
        </div>

        <!-- Step 2: Body Measurements -->
        <div class="form-step" id="step2" data-step="2">
            <div class="row gy-3">
                <div class="col-12">
                    <h5 class="mb-3">Body Measurements</h5>
                    <p class="text-muted mb-4">These measurements help us calculate your body composition ratios. All measurements are optional but provide more accurate assessments.</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="waist_circumference">Waist Circumference (cm)
                        <span class="help-tooltip">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                            <span class="tooltip-text">Measure at the narrowest point, usually just above the navel</span>
                        </span>
                    </label>
                    <input type="number" name="waist_circumference" id="waist_circumference" class="form-control" placeholder="80" min="30" max="200" step="0.1">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="hip_circumference">Hip Circumference (cm)
                        <span class="help-tooltip">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                            <span class="tooltip-text">Measure at the widest point around your hips and buttocks</span>
                        </span>
                    </label>
                    <input type="number" name="hip_circumference" id="hip_circumference" class="form-control" placeholder="95" min="30" max="200" step="0.1">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="whr">Waist-to-Hip Ratio (WHR)</label>
                    <input type="number" name="whr" id="whr" class="form-control readonly-field" placeholder="Auto-calculated" step="0.01" readonly>
                    <small class="text-muted">Calculated automatically from waist and hip measurements</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="neck_circumference">Neck Circumference (cm)
                        <span class="help-tooltip">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                            <span class="tooltip-text">Measure around your neck, just below the Adam's apple</span>
                        </span>
                    </label>
                    <input type="number" name="neck_circumference" id="neck_circumference" class="form-control" placeholder="38" min="20" max="60" step="0.1">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="muac">Mid-Upper Arm Circumference (MUAC) (cm)
                        <span class="help-tooltip">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                            <span class="tooltip-text">Measure the circumference at the midpoint of your upper arm</span>
                        </span>
                    </label>
                    <input type="number" name="muac" id="muac" class="form-control" placeholder="28" min="10" max="50" step="0.1">
                </div>
                <div class="col-12">
                    <div class="skip-section">
                        <span class="skip-link" onclick="skipStep(3)">Skip this section if you don't have measuring tools</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 3: Health Vitals -->
        <div class="form-step" id="step3" data-step="3">
            <div class="row gy-3">
                <div class="col-12">
                    <h5 class="mb-3">Health Vitals</h5>
                    <p class="text-muted mb-4">These vital signs help assess your cardiovascular health. All measurements are optional.</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="systolic_bp">Systolic Blood Pressure (mmHg)
                        <span class="help-tooltip">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                            <span class="tooltip-text">The higher number in your blood pressure reading (e.g., 120 in 120/80)</span>
                        </span>
                    </label>
                    <input type="number" name="systolic_bp" id="systolic_bp" class="form-control" placeholder="120" min="50" max="250" step="1">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="diastolic_bp">Diastolic Blood Pressure (mmHg)
                        <span class="help-tooltip">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                            <span class="tooltip-text">The lower number in your blood pressure reading (e.g., 80 in 120/80)</span>
                        </span>
                    </label>
                    <input type="number" name="diastolic_bp" id="diastolic_bp" class="form-control" placeholder="80" min="30" max="150" step="1">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="resting_hr">Resting Heart Rate (bpm)
                        <span class="help-tooltip">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                            <span class="tooltip-text">Count your pulse for 15 seconds and multiply by 4, when at rest</span>
                        </span>
                    </label>
                    <input type="number" name="resting_hr" id="resting_hr" class="form-control" placeholder="70" min="30" max="200" step="1">
                </div>
                <div class="col-12">
                    <div class="skip-section">
                        <span class="skip-link" onclick="skipStep(4)">Skip this section if you don't have recent vitals</span>
                    </div>
                </div>
            </div>
        </div>


        <!-- Step 4: Activity & Lifestyle -->
        <div class="form-step" id="step4" data-step="4">
            <div class="row gy-3">
                <div class="col-12">
                    <h5 class="mb-3">Activity & Lifestyle</h5>
                    <p class="text-muted mb-4">Tell us about your activity level and lifestyle factors that may affect your health.</p>
                </div>
                <div class="col-12">
                    <fieldset>
                        <legend class="form-label">Physical Activity Level <span class="text-danger">*</span></legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="activityLevel" value="sedentary" id="activitySedentary" required>
                                    <label class="form-check-label px-4" for="activitySedentary">
                                        <strong>Sedentary</strong><br>
                                        <small class="text-muted">Little or no exercise</small>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="activityLevel" value="lightly-active" id="activityLight" required>
                                    <label class="form-check-label px-4" for="activityLight">
                                        <strong>Lightly Active</strong><br>
                                        <small class="text-muted">Light exercise 1-3 days/week</small>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="activityLevel" value="moderately-active" id="activityModerate" required>
                                    <label class="form-check-label px-4" for="activityModerate">
                                        <strong>Moderately Active</strong><br>
                                        <small class="text-muted">Moderate exercise 3-5 days/week</small>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="activityLevel" value="very-active" id="activityVery" required>
                                    <label class="form-check-label px-4" for="activityVery">
                                        <strong>Very Active</strong><br>
                                        <small class="text-muted">Hard exercise 6-7 days/week</small>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="activityLevel" value="extremely-active" id="activityExtreme" required>
                                    <label class="form-check-label px-4" for="activityExtreme">
                                        <strong>Extremely Active</strong><br>
                                        <small class="text-muted">Very hard exercise, physical job</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="validation-message" id="activityLevel-error">Please select your activity level.</div>
                    </fieldset>
                </div>
                <div class="col-12 mt-4">
                    <fieldset>
                        <legend class="form-label">Lifestyle Factors <small class="text-muted">(Select all that apply)</small></legend>
                        @php
                            $lifestyleOptions = [
                                'smoking' => 'Smoking',
                                'alcohol' => 'Regular alcohol consumption',
                                'stress' => 'High stress levels',
                                'poor-diet' => 'Poor dietary habits',
                                'irregular-sleep' => 'Irregular sleep patterns',
                                'family-history' => 'Family history of diabetes'
                            ];
                        @endphp
                        <div class="row">
                            @foreach($lifestyleOptions as $val => $label)
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="lifestyleFactors[]" value="{{ $val }}" id="life_{{ $val }}">
                                        <label class="form-check-label px-4" for="life_{{ $val }}">{{ $label }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>

        <!-- Step 5: Medical History -->
        <div class="form-step" id="step5" data-step="5">
            <div class="row gy-3">
                <div class="col-12">
                    <h5 class="mb-3">Medical History</h5>
                    <p class="text-muted mb-4">Help us understand your medical background and family history for a more accurate assessment.</p>
                </div>
                <div class="col-12">
                    <fieldset>
                        <legend class="form-label">Co-morbidities <small class="text-muted">(Select all that apply)</small></legend>
                        @php
                            $comorbidities = [
                                'hypertension' => 'Hypertension (High Blood Pressure)',
                                'obesity' => 'Obesity',
                                'heart-disease' => 'Heart Disease',
                                'kidney-disease' => 'Kidney Disease',
                                'thyroid' => 'Thyroid Disorders',
                                'depression' => 'Depression/Anxiety',
                                'sleep-apnea' => 'Sleep Apnea',
                                'arthritis' => 'Arthritis',
                                'none' => 'None of the above'
                            ];
                        @endphp
                        <div class="row">
                            @foreach($comorbidities as $val => $label)
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="comorbidities[]" value="{{ $val }}" id="co_{{ $val }}">
                                        <label class="form-check-label px-4" for="co_{{ $val }}">{{ $label }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </fieldset>
                </div>
                <div class="col-12 mt-4">
                    <label class="form-label" for="familyHistory">Family History of Diabetes</label>
                    <textarea name="familyHistory" id="familyHistory" class="form-control" rows="4" placeholder="Please describe any family history of diabetes (parents, siblings, grandparents, etc.)"></textarea>
                    <small class="text-muted">Include information about immediate family members with diabetes, type of diabetes, and age of diagnosis if known</small>
                </div>
            </div>
        </div>

        <!-- Step 6: Contact & Review -->
        <div class="form-step" id="step6" data-step="6">
            <div class="row gy-3">
                <div class="col-12">
                    <h5 class="mb-3">Contact Information & Review</h5>
                    <p class="text-muted mb-4">Optionally provide your contact information and review your responses before submission.</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="email">Email Address <small class="text-muted">(optional)</small></label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="your.email@example.com">
                    <small class="text-muted">We'll send you a copy of your assessment results</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="phone">Phone Number <small class="text-muted">(optional)</small></label>
                    <input type="hidden" name="countryCode" value="+234">
                    <input type="tel" name="phone" id="phone" class="form-control" placeholder="+234 000 000 0000">
                    <small class="text-muted">For follow-up consultations</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="assessmentDate">Assessment Date</label>
                    <input type="date" name="assessmentDate" id="assessmentDate" class="form-control">
                </div>
                <div class="col-12 mt-4">
                    <h6 class="mb-3">Assessment Summary</h6>
                    <div class="summary-section" id="assessmentSummary">
                        <!-- Summary will be populated by JavaScript -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="step-navigation">
            <button type="button" class="btn btn-outline-primary" id="prevBtn" onclick="changeStep(-1)" style="display: none;">
                <svg width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                </svg>
                Previous
            </button>
            <button type="button" class="btn btn-primary" id="nextBtn" onclick="changeStep(1)">
                Next
                <svg width="16" height="16" fill="currentColor" class="ms-2" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn" style="display: none;">
                <span id="submitText">Submit Health Assessment</span>
            </button>
        </div>
        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Multi-step form management
        let currentStep = 1;
        const totalSteps = 6;
        const formData = {};

        // Step configuration
        const stepConfig = {
            1: { title: "Basic Profile", description: "Age, height, weight, and gender" },
            2: { title: "Body Measurements", description: "Waist, hip, neck, and arm measurements" },
            3: { title: "Health Vitals", description: "Blood pressure and heart rate" },
            4: { title: "Activity & Lifestyle", description: "Physical activity and lifestyle factors" },
            5: { title: "Medical History", description: "Medical conditions and family history" },
            6: { title: "Contact & Review", description: "Contact info and review responses" }
        };

        document.addEventListener('DOMContentLoaded', function() {
            initializeForm();
            setupCalculations();
            setupValidation();
            updateStepDisplay();
        });

        function initializeForm() {
            // Set current date for assessment date
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('assessmentDate').value = today;

            // Initialize form data preservation
            setupFormDataPersistence();
        }

        function setupCalculations() {
            const heightInput = document.getElementById('height');
            const weightInput = document.getElementById('weight');
            const bmiInput = document.getElementById('bmi');
            const waistInput = document.getElementById('waist_circumference');
            const hipInput = document.getElementById('hip_circumference');
            const whrInput = document.getElementById('whr');

            // Calculate BMI
            function calculateBMI() {
                const height = parseFloat(heightInput.value);
                const weight = parseFloat(weightInput.value);
                
                if (height && weight && height > 0) {
                    const heightInMeters = height / 100;
                    const bmi = weight / (heightInMeters * heightInMeters);
                    bmiInput.value = bmi.toFixed(1);
                } else {
                    bmiInput.value = '';
                }
            }

            // Calculate WHR (Waist-to-Hip Ratio)
            function calculateWHR() {
                const waist = parseFloat(waistInput.value);
                const hip = parseFloat(hipInput.value);
                
                if (waist && hip && hip > 0) {
                    const whr = waist / hip;
                    whrInput.value = whr.toFixed(2);
                } else {
                    whrInput.value = '';
                }
            }

            // Add event listeners for calculations
            heightInput?.addEventListener('input', calculateBMI);
            weightInput?.addEventListener('input', calculateBMI);
            waistInput?.addEventListener('input', calculateWHR);
            hipInput?.addEventListener('input', calculateWHR);
        }

        function setupValidation() {
            // Real-time validation for all inputs
            const form = document.getElementById('healthAssessmentForm');
            const inputs = form.querySelectorAll('input, select, textarea');
            
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    validateField(this);
                });
                
                input.addEventListener('input', function() {
                    if (this.classList.contains('is-invalid')) {
                        validateField(this);
                    }
                });
            });
        }

        function validateField(field) {
            const value = field.value.trim();
            const isRequired = field.hasAttribute('required');
            let isValid = true;
            let errorMessage = '';

            // Check required fields
            if (isRequired && !value) {
                isValid = false;
                errorMessage = 'This field is required';
            }

            // Type-specific validation
            if (value && field.type === 'email') {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    isValid = false;
                    errorMessage = 'Please enter a valid email address';
                }
            }

            if (value && field.type === 'number') {
                const min = parseFloat(field.min);
                const max = parseFloat(field.max);
                const numValue = parseFloat(value);
                
                if (!isNaN(min) && numValue < min) {
                    isValid = false;
                    errorMessage = `Value must be at least ${min}`;
                }
                if (!isNaN(max) && numValue > max) {
                    isValid = false;
                    errorMessage = `Value must be no more than ${max}`;
                }
            }

            // Update field appearance
            if (isValid) {
                field.classList.remove('is-invalid');
                hideValidationMessage(field);
            } else {
                field.classList.add('is-invalid');
                showValidationMessage(field, errorMessage);
            }

            return isValid;
        }

        function validateRadioGroup(groupName) {
            const radios = document.querySelectorAll(`input[name="${groupName}"]`);
            const isSelected = Array.from(radios).some(radio => radio.checked);
            
            if (!isSelected) {
                showValidationMessage(radios[0], 'Please make a selection');
                return false;
            }
            
            hideValidationMessage(radios[0]);
            return true;
        }

        function showValidationMessage(field, message) {
            const errorElement = document.getElementById(field.name + '-error') || 
                                document.getElementById(field.id + '-error');
            if (errorElement) {
                errorElement.textContent = message;
                errorElement.classList.add('show');
            }
        }

        function hideValidationMessage(field) {
            const errorElement = document.getElementById(field.name + '-error') || 
                                document.getElementById(field.id + '-error');
            if (errorElement) {
                errorElement.classList.remove('show');
            }
        }

        function setupFormDataPersistence() {
            const form = document.getElementById('healthAssessmentForm');
            const inputs = form.querySelectorAll('input, select, textarea');
            
            inputs.forEach(input => {
                input.addEventListener('change', function() {
                    if (this.type === 'checkbox') {
                        if (!formData[this.name]) formData[this.name] = [];
                        if (this.checked) {
                            if (!formData[this.name].includes(this.value)) {
                                formData[this.name].push(this.value);
                            }
                        } else {
                            formData[this.name] = formData[this.name].filter(v => v !== this.value);
                        }
                    } else if (this.type === 'radio') {
                        formData[this.name] = this.value;
                    } else {
                        formData[this.name] = this.value;
                    }
                });
            });
        }

        function changeStep(direction) {
            const newStep = currentStep + direction;
            
            if (newStep < 1 || newStep > totalSteps) {
                return;
            }
            
            // Validate current step before proceeding
            if (direction > 0 && !validateCurrentStep()) {
                return;
            }
            
            // Save current step data
            saveStepData(currentStep);
            
            // Hide current step
            const currentStepElement = document.getElementById(`step${currentStep}`);
            currentStepElement.classList.remove('active');
            
            // Update step number
            currentStep = newStep;
            
            // Show new step with animation
            setTimeout(() => {
                const newStepElement = document.getElementById(`step${currentStep}`);
                newStepElement.classList.add('active');
                updateStepDisplay();
                
                // Generate summary if on final step
                if (currentStep === totalSteps) {
                    generateSummary();
                }
            }, 100);
        }

        function skipStep(targetStep) {
            if (targetStep <= totalSteps) {
                saveStepData(currentStep);
                document.getElementById(`step${currentStep}`).classList.remove('active');
                currentStep = targetStep;
                document.getElementById(`step${currentStep}`).classList.add('active');
                updateStepDisplay();
            }
        }

        function validateCurrentStep() {
            const currentStepElement = document.getElementById(`step${currentStep}`);
            const requiredInputs = currentStepElement.querySelectorAll('input[required], select[required]');
            let isValid = true;
            
            // Validate required fields
            requiredInputs.forEach(input => {
                if (!validateField(input)) {
                    isValid = false;
                }
            });
            
            // Special validation for radio groups
            if (currentStep === 1) {
                if (!validateRadioGroup('gender')) {
                    isValid = false;
                }
            }
            
            if (currentStep === 4) {
                if (!validateRadioGroup('activityLevel')) {
                    isValid = false;
                }
            }
            
            if (!isValid) {
                // Scroll to first error
                const firstError = currentStepElement.querySelector('.is-invalid');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }
            }
            
            return isValid;
        }

        function saveStepData(step) {
            const stepElement = document.getElementById(`step${step}`);
            const inputs = stepElement.querySelectorAll('input, select, textarea');
            
            inputs.forEach(input => {
                if (input.type === 'checkbox') {
                    if (!formData[input.name]) formData[input.name] = [];
                    if (input.checked && !formData[input.name].includes(input.value)) {
                        formData[input.name].push(input.value);
                    } else if (!input.checked) {
                        formData[input.name] = formData[input.name].filter(v => v !== input.value);
                    }
                } else if (input.type === 'radio' && input.checked) {
                    formData[input.name] = input.value;
                } else if (input.type !== 'radio') {
                    formData[input.name] = input.value;
                }
            });
        }

        function updateStepDisplay() {
            // Update progress bar
            const progressBar = document.getElementById('progressBar');
            const progressPercentage = (currentStep / totalSteps) * 100;
            progressBar.style.width = progressPercentage + '%';
            
            // Update step title and counter
            document.getElementById('stepTitle').textContent = `Step ${currentStep}: ${stepConfig[currentStep].title}`;
            document.getElementById('stepCounter').textContent = `${currentStep} of ${totalSteps}`;
            
            // Update step indicators
            for (let i = 1; i <= totalSteps; i++) {
                const circle = document.getElementById(`step-${i}-circle`);
                const label = document.getElementById(`step-${i}-label`);
                
                if (i < currentStep) {
                    circle.className = 'step-circle completed';
                    circle.innerHTML = '✓';
                    label.className = 'step-label';
                } else if (i === currentStep) {
                    circle.className = 'step-circle active';
                    circle.innerHTML = i;
                    label.className = 'step-label active';
                } else {
                    circle.className = 'step-circle inactive';
                    circle.innerHTML = i;
                    label.className = 'step-label';
                }
            }
            
            // Update navigation buttons
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const submitBtn = document.getElementById('submitBtn');
            
            prevBtn.style.display = currentStep > 1 ? 'block' : 'none';
            
            if (currentStep < totalSteps) {
                nextBtn.style.display = 'block';
                submitBtn.style.display = 'none';
            } else {
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'block';
            }
        }

        function generateSummary() {
            const summaryContainer = document.getElementById('assessmentSummary');
            let summaryHTML = '';
            
            // Basic information
            if (formData.age || formData.height || formData.weight) {
                summaryHTML += '<div class="summary-item"><span class="summary-label">Basic Info:</span>';
                summaryHTML += '<span class="summary-value">';
                if (formData.age) summaryHTML += `Age: ${formData.age}y`;
                if (formData.height) summaryHTML += `, Height: ${formData.height}cm`;
                if (formData.weight) summaryHTML += `, Weight: ${formData.weight}kg`;
                if (formData.bmi) summaryHTML += ` (BMI: ${formData.bmi})`;
                summaryHTML += '</span></div>';
            }
            
            // Gender
            if (formData.gender) {
                summaryHTML += `<div class="summary-item"><span class="summary-label">Gender:</span><span class="summary-value">${formatGender(formData.gender)}</span></div>`;
            }
            
            // Activity level
            if (formData.activityLevel) {
                summaryHTML += `<div class="summary-item"><span class="summary-label">Activity Level:</span><span class="summary-value">${formatActivityLevel(formData.activityLevel)}</span></div>`;
            }
            
            // Body measurements
            const measurements = [];
            if (formData.waist_circumference) measurements.push(`Waist: ${formData.waist_circumference}cm`);
            if (formData.hip_circumference) measurements.push(`Hip: ${formData.hip_circumference}cm`);
            if (formData.whr) measurements.push(`WHR: ${formData.whr}`);
            if (measurements.length > 0) {
                summaryHTML += `<div class="summary-item"><span class="summary-label">Body Measurements:</span><span class="summary-value">${measurements.join(', ')}</span></div>`;
            }
            
            // Vitals
            const vitals = [];
            if (formData.systolic_bp) vitals.push(`${formData.systolic_bp}/${formData.diastolic_bp || '?'} mmHg`);
            if (formData.resting_hr) vitals.push(`HR: ${formData.resting_hr} bpm`);
            if (vitals.length > 0) {
                summaryHTML += `<div class="summary-item"><span class="summary-label">Vitals:</span><span class="summary-value">${vitals.join(', ')}</span></div>`;
            }
            
            // Lifestyle factors
            if (formData.lifestyleFactors && formData.lifestyleFactors.length > 0) {
                summaryHTML += `<div class="summary-item"><span class="summary-label">Lifestyle Factors:</span><span class="summary-value">${formData.lifestyleFactors.length} selected</span></div>`;
            }
            
            // Co-morbidities
            if (formData.comorbidities && formData.comorbidities.length > 0) {
                summaryHTML += `<div class="summary-item"><span class="summary-label">Medical Conditions:</span><span class="summary-value">${formData.comorbidities.length} selected</span></div>`;
            }
            
            if (!summaryHTML) {
                summaryHTML = '<div class="text-muted">Complete previous steps to see your assessment summary</div>';
            }
            
            summaryContainer.innerHTML = summaryHTML;
        }

        function formatGender(gender) {
            const genderMap = {
                'male': 'Male',
                'female': 'Female',
                'other': 'Other',
                'prefer-not-to-say': 'Prefer not to say'
            };
            return genderMap[gender] || gender;
        }

        function formatActivityLevel(level) {
            const levelMap = {
                'sedentary': 'Sedentary',
                'lightly-active': 'Lightly Active',
                'moderately-active': 'Moderately Active',
                'very-active': 'Very Active',
                'extremely-active': 'Extremely Active'
            };
            return levelMap[level] || level;
        }

        // Form submission
        document.getElementById('healthAssessmentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Final validation
            if (!validateCurrentStep()) {
                return false;
            }
            
            // Show loading state
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            
            submitBtn.disabled = true;
            submitText.innerHTML = '<span class="loading-spinner"></span>Processing Assessment...';
            
            // Submit form
            setTimeout(() => {
                this.submit();
            }, 500);
        });

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA') {
                e.preventDefault();
                if (currentStep < totalSteps) {
                    changeStep(1);
                }
            }
        });
    </script>

@endsection