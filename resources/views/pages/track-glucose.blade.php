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
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .input-group-text {
            border: 1px solid #ced4da;
            padding: 0.375rem 0.75rem;
        }
        .btn-primary {
            background-color: #0ea5e9;
            border-color: #0ea5e9;
            padding: 0.75rem 2rem;
            font-weight: 500;
        }
        .btn-primary:hover {
            background-color: #0284c7;
            border-color: #0284c7;
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
    </style>
 
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title mb-0">Comprehensive Health Assessment</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
    <form action="{{ route('ai_result') }}" method="post" id="healthAssessmentForm">
        @csrf

        <!-- Basic Information -->
        <div class="row gy-3 mb-4">
            <div class="col-md-6">
                <label class="form-label">Age (years)</label>
                <input type="number" name="age" class="form-control" placeholder="35" min="1" max="120">
            </div>
            <div class="col-md-6">
                <label class="form-label">Height (cm)</label>
                <input type="number" name="height" class="form-control" placeholder="170" min="50" max="250">
            </div>
            <div class="col-md-6">
                <label class="form-label">Weight (kg)</label>
                <input type="number" name="weight" class="form-control" placeholder="70" min="20" max="300" step="0.1">
            </div>
             <div class="col-md-6">
        <label class="form-label">BMI (kg/m²)</label>
        <input type="number" name="bmi" class="form-control" placeholder="24.2" step="0.1" readonly>
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
        <input type="number" name="whr" class="form-control" placeholder="0.85" step="0.01" readonly>
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
                <label class="form-label">Physical Activity Level</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="activityLevel[]" value="sedentary" id="activitySedentary">
                    <label class="form-check-label px-4" for="activitySedentary">Sedentary</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="activityLevel[]" value="lightly-active" id="activityLight">
                    <label class="form-check-label px-4" for="activityLight">Lightly Active</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="activityLevel[]" value="moderately-active" id="activityModerate">
                    <label class="form-check-label px-4" for="activityModerate">Moderately Active</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="activityLevel[]" value="very-active" id="activityVery">
                    <label class="form-check-label px-4" for="activityVery">Very Active</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="activityLevel[]" value="extremely-active" id="activityExtreme">
                    <label class="form-check-label px-4" for="activityExtreme">Extremely Active</label>
                </div>
            </div>
        </div>

        <!-- Lifestyle Factors -->
        <div class="row gy-3 mb-4">
            <div class="col-12">
                <label class="form-label">Lifestyle Factors</label>
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
            </div>
        </div>

        <!-- Co-morbidities -->
        <div class="row gy-3 mb-4">
            <div class="col-12">
                <label class="form-label">Co-morbidities</label>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 

@endsection