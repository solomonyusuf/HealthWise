@extends('shared.layout')
@section('content')

 <style>
        .bg-base {
            background-color: #f8f9fa;
        }
        .card {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem 1.25rem;
        }
        .card-body {
            padding: 1.25rem;
        }
        .form-control, .form-select {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            padding: 0.375rem 0.75rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 0.25rem rgba(16, 185, 129, 0.25);
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
            background-color: #10b981;
            border-color: #10b981;
            padding: 0.75rem 2rem;
            font-weight: 500;
        }
        .btn-primary:hover {
            background-color: #059669;
            border-color: #059669;
        }
        .text-sm {
            font-size: 0.875rem;
        }
        .mt-24 {
            margin-top: 1.5rem;
        }
        .w-90-px {
            width: 90px;
        }
        .gy-3 > * {
            margin-bottom: 1rem;
        }
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
    
        }
        .card-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
        }
        .is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        }
        .text-danger {
            color: #dc3545;
        }
        .readonly-field {
            background-color: #f8f9fa;
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
                        
                        <form action="{{ route('ai_result') }}" method="post" id="healthAssessmentForm">
        @csrf

        <!-- Basic Information -->
        <div class="row gy-3 mb-4">
            <div class="col-md-6">
                <label class="form-label">Age (years) <span class="text-danger">*</span></label>
                <input type="number" name="age" class="form-control" placeholder="35" min="1" max="120" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Height (cm) <span class="text-danger">*</span></label>
                <input type="number" name="height" class="form-control" placeholder="170" min="50" max="250" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Weight (kg) <span class="text-danger">*</span></label>
                <input type="number" name="weight" class="form-control" placeholder="70" min="20" max="300" step="0.1" required>
            </div>
             <div class="col-md-6">
        <label class="form-label">BMI (kg/m²)</label>
        <input type="number" name="bmi" class="form-control readonly-field" placeholder="Auto-calculated" step="0.1" readonly>
    </div>

    <!-- Waist Circumference -->
    <div class="col-md-6">
        <label class="form-label">Waist Circumference (cm)</label>
        <input type="number" name="waist_circumference" class="form-control" placeholder="80" min="30" max="200" step="0.1">
    </div>

    <!-- Hip Circumference -->
    <div class="col-md-6">
        <label class="form-label">Hip Circumference (cm)</label>
        <input type="number" name="hip_circumference" class="form-control" placeholder="95" min="30" max="200" step="0.1">
    </div>

    <!-- Waist-to-Hip Ratio (WHR) -->
    <div class="col-md-6">
        <label class="form-label">Waist-to-Hip Ratio (WHR)</label>
        <input type="number" name="whr" class="form-control readonly-field" placeholder="Auto-calculated" step="0.01" readonly>
    </div>

    <!-- Neck Circumference -->
    <div class="col-md-6">
        <label class="form-label">Neck Circumference (cm)</label>
        <input type="number" name="neck_circumference" class="form-control" placeholder="38" min="20" max="60" step="0.1">
    </div>

    <!-- Mid-Upper Arm Circumference (MUAC) -->
    <div class="col-md-6">
        <label class="form-label">Mid-Upper Arm Circumference (MUAC) (cm)</label>
        <input type="number" name="muac" class="form-control" placeholder="28" min="10" max="50" step="0.1">
    </div>
    
            <div class="col-md-6">
                <label class="form-label">Gender</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="male" id="genderMale">
                    <label class="form-check-label  px-4" for="genderMale">Male</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="female" id="genderFemale">
                    <label class="form-check-label px-4" for="genderFemale">Female</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="other" id="genderOther">
                    <label class="form-check-label px-4" for="genderOther">Other</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="prefer-not-to-say" id="genderNA">
                    <label class="form-check-label px-4" for="genderNA">Prefer not to say</label>
                </div>
            </div>
        </div>

        <!-- Blood Tests -->
        {{-- <div class="row gy-3 mb-4">
            <div class="col-12">
                <h6 class="text-primary mb-3">BMI Section</h6>
            </div>
            <div class="col-md-6">
                <label class="form-label">BMI</label>
                <div class="input-group">
                    <span class="input-group-text bg-base">🩸</span>
                    <input type="number" name="bloodSugar" class="form-control" placeholder="100" min="50" max="500">
                </div>
                <p class="text-sm mt-1 mb-0 text-muted">Fasting blood glucose level</p>
            </div>
            <div class="col-md-6">
                <label class="form-label">Insulin Level (μU/mL)</label>
                <div class="input-group">
                    <span class="input-group-text bg-base">💉</span>
                    <input type="number" name="insulinLevel" class="form-control" placeholder="15" min="0" max="100" step="0.1">
                </div>
            </div>
        </div> --}}

        <!-- Blood Pressure -->
        {{-- <div class="row gy-3 mb-4">
            <div class="col-12">
                <h6 class="text-primary mb-3">Blood Pressure</h6>
            </div>
            <div class="col-md-6">
                <label class="form-label">Systolic BP</label>
                <div class="input-group">
                    <span class="input-group-text bg-base">❤️</span>
                    <input type="number" name="systolicBP" class="form-control" placeholder="120" min="70" max="200">
                    <span class="input-group-text bg-base">mmHg</span>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Diastolic BP</label>
                <div class="input-group">
                    <span class="input-group-text bg-base">❤️</span>
                    <input type="number" name="diastolicBP" class="form-control" placeholder="80" min="40" max="130">
                    <span class="input-group-text bg-base">mmHg</span>
                </div>
            </div>
        </div> --}}

        <div class="row mt-3">
    <!-- Systolic Blood Pressure -->
    <div class="col-md-6">
        <label class="form-label">Systolic Blood Pressure (mmHg) optional</label>
        <input type="number" name="systolic_bp" class="form-control" placeholder="120" min="50" max="250" step="1">
    </div>

    <!-- Diastolic Blood Pressure -->
    <div class="col-md-6">
        <label class="form-label">Diastolic Blood Pressure (mmHg) optional</label>
        <input type="number" name="diastolic_bp" class="form-control" placeholder="80" min="30" max="150" step="1">
    </div>

    <!-- Resting Heart Rate -->
    <div class="col-md-6">
        <label class="form-label">Resting Heart Rate (bpm) optional</label>
        <input type="number" name="resting_hr" class="form-control" placeholder="70" min="30" max="200" step="1">
    </div>
</div>

        <!-- Physical Activity -->
        <div class="row gy-3 mb-4">
            <div class="col-12">
                <fieldset>
                    <legend class="form-label">Physical Activity Level <span class="text-danger">*</span></legend>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="activityLevel" value="sedentary" id="activitySedentary">
                    <label class="form-check-label px-4" for="activitySedentary">Sedentary</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="activityLevel" value="lightly-active" id="activityLight">
                    <label class="form-check-label px-4" for="activityLight">Lightly Active</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="activityLevel" value="moderately-active" id="activityModerate">
                    <label class="form-check-label px-4" for="activityModerate">Moderately Active</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="activityLevel" value="very-active" id="activityVery">
                    <label class="form-check-label px-4" for="activityVery">Very Active</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="activityLevel" value="extremely-active" id="activityExtreme">
                    <label class="form-check-label px-4" for="activityExtreme">Extremely Active</label>
                </div>
                </fieldset>
            </div>
        </div>

        <!-- Lifestyle Factors -->
        <div class="row gy-3 mb-4">
            <div class="col-12">
                <fieldset>
                    <legend class="form-label">Lifestyle Factors (Select all that apply)</legend>
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
                @foreach($lifestyleOptions as $val => $label)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="lifestyleFactors[]" value="{{ $val }}" id="life_{{ $val }}">
                        <label class="form-check-label px-4" for="life_{{ $val }}">{{ $label }}</label>
                    </div>
                @endforeach
                </fieldset>
            </div>
        </div>

        <!-- Co-morbidities -->
        <div class="row gy-3 mb-4">
            <div class="col-12">
                <fieldset>
                    <legend class="form-label">Co-morbidities (Select all that apply)</legend>
                @php
                    $comorbidities = [
                        'hypertension' => 'Hypertension',
                        'obesity' => 'Obesity',
                        'heart-disease' => 'Heart Disease',
                        'kidney-disease' => 'Kidney Disease',
                        'thyroid' => 'Thyroid Disorders',
                        'depression' => 'Depression/Anxiety',
                        'sleep-apnea' => 'Sleep Apnea',
                        'arthritis' => 'Arthritis',
                        'none' => 'None'
                    ];
                @endphp
                @foreach($comorbidities as $val => $label)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="comorbidities[]" value="{{ $val }}" id="co_{{ $val }}">
                        <label class="form-check-label px-4" for="co_{{ $val }}">{{ $label }}</label>
                    </div>
                @endforeach
                </fieldset>
            </div>
        </div>

        <!-- Family History -->
        <div class="row gy-3 mb-4">
            <div class="col-12">
                <label class="form-label">Family History of Diabetes</label>
                <textarea name="familyHistory" class="form-control" rows="4" placeholder="Please describe any family history of diabetes (parents, siblings, etc.)"></textarea>
                <p class="text-sm mt-1 mb-0">Include info about immediate family members with diabetes</p>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="row gy-3 mb-4">
            <div class="col-12">
                <h6 class="text-primary mb-3">Contact Information (Optional)</h6>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-base">✉️</span>
                    <input type="email" name="email" class="form-control" placeholder="info@gmail.com">
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Phone Number</label>
                <div class="input-group">
                    <input type="hidden" name="countryCode" value="+234">
                    <input type="tel" name="phone" class="form-control" placeholder="(555) 253-08515">
                </div>
            </div>
        </div>

        <!-- Assessment Date -->
        <div class="row gy-3 mb-4">
            <div class="col-md-6">
                <label class="form-label">Assessment Date</label>
                <input type="date" name="assessmentDate" class="form-control">
            </div>
        </div>

        <!-- Submit Button -->
        <div class="row">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary btn-lg">📋 Submit Health Information</button>
            </div>
        </div>
        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const heightInput = document.querySelector('input[name="height"]');
            const weightInput = document.querySelector('input[name="weight"]');
            const bmiInput = document.querySelector('input[name="bmi"]');
            const waistInput = document.querySelector('input[name="waist_circumference"]');
            const hipInput = document.querySelector('input[name="hip_circumference"]');
            const whrInput = document.querySelector('input[name="whr"]');

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

            // Add event listeners
            heightInput.addEventListener('input', calculateBMI);
            weightInput.addEventListener('input', calculateBMI);
            waistInput.addEventListener('input', calculateWHR);
            hipInput.addEventListener('input', calculateWHR);

            // Form validation
            const form = document.getElementById('healthAssessmentForm');
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('input[required], select[required]');
                let hasErrors = false;

                // Check required fields
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        hasErrors = true;
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });

                // Check if at least one gender is selected
                const genderInputs = form.querySelectorAll('input[name="gender"]');
                const genderSelected = Array.from(genderInputs).some(input => input.checked);
                if (!genderSelected) {
                    hasErrors = true;
                    alert('Please select your gender.');
                }

                if (hasErrors) {
                    e.preventDefault();
                    alert('Please fill in all required fields.');
                    return false;
                }

                // Show loading state
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '⏳ Processing...';
                
                return true;
            });
        });
    </script>

@endsection