<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HealthAssessmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'age' => 'required|integer|min:1|max:120',
            'height' => 'required|numeric|min:50|max:250',
            'weight' => 'required|numeric|min:20|max:300',
            'bmi' => 'nullable|numeric',
            'waist_circumference' => 'nullable|numeric|min:30|max:200',
            'hip_circumference' => 'nullable|numeric|min:30|max:200',
            'whr' => 'nullable|numeric',
            'neck_circumference' => 'nullable|numeric|min:20|max:60',
            'muac' => 'nullable|numeric|min:10|max:50',
            'gender' => 'required|in:male,female,other,prefer-not-to-say',
            'systolic_bp' => 'nullable|integer|min:50|max:250',
            'diastolic_bp' => 'nullable|integer|min:30|max:150',
            'resting_hr' => 'nullable|integer|min:30|max:200',
            'activityLevel' => 'required|in:sedentary,lightly-active,moderately-active,very-active,extremely-active',
            'lifestyleFactors' => 'nullable|array',
            'lifestyleFactors.*' => 'in:smoking,alcohol,stress,poor-diet,irregular-sleep,family-history',
            'comorbidities' => 'nullable|array',
            'comorbidities.*' => 'in:hypertension,obesity,heart-disease,kidney-disease,thyroid,depression,sleep-apnea,arthritis,none',
            'familyHistory' => 'nullable|string|max:1000',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'countryCode' => 'nullable|string|max:10',
            'assessmentDate' => 'nullable|date',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'age.required' => 'Age is required.',
            'age.min' => 'Age must be at least 1 year.',
            'age.max' => 'Age must not exceed 120 years.',
            'height.required' => 'Height is required.',
            'height.min' => 'Height must be at least 50 cm.',
            'height.max' => 'Height must not exceed 250 cm.',
            'weight.required' => 'Weight is required.',
            'weight.min' => 'Weight must be at least 20 kg.',
            'weight.max' => 'Weight must not exceed 300 kg.',
            'gender.required' => 'Please select your gender.',
            'activityLevel.required' => 'Please select your physical activity level.',
        ];
    }
}
