@extends('shared.layout')
@section('content')
    <style>
        :root {
            --meal-primary: #28a745;
            --meal-secondary: #20c997;
            --meal-light: #e8f5e8;
            --meal-lighter: #f0f9f0;
            --activity-primary: #007bff;
            --activity-secondary: #6f42c1;
            --activity-light: #e3f2fd;
            --activity-lighter: #f3f8ff;
            --shadow-sm: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            --shadow-md: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            --shadow-lg: 0 1rem 3rem rgba(0, 0, 0, 0.175);
            --border-radius: 1rem;
            --border-radius-sm: 0.5rem;
            --border-radius-lg: 1.5rem;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --font-weight-medium: 500;
            --font-weight-semibold: 600;
            --font-weight-bold: 700;
        }

        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
        }

        .container-fluid {
            background: transparent;
        }

        .meal-card {
            background: linear-gradient(135deg, var(--meal-light) 0%, var(--meal-lighter) 100%);
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .meal-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, var(--meal-primary) 0%, var(--meal-secondary) 100%);
        }

        .meal-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
            background: linear-gradient(135deg, #e0f2e0 0%, #ecf7ec 100%);
        }

        .activity-card {
            background: linear-gradient(135deg, var(--activity-light) 0%, var(--activity-lighter) 100%);
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .activity-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, var(--activity-primary) 0%, var(--activity-secondary) 100%);
        }

        .activity-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
            background: linear-gradient(135deg, #dbeafe 0%, #eff6ff 100%);
        }

        .time-badge {
            background: linear-gradient(135deg, var(--meal-primary) 0%, var(--meal-secondary) 100%);
            color: white;
            font-weight: var(--font-weight-semibold);
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-size: 0.875rem;
            box-shadow: var(--shadow-sm);
            border: 2px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .activity-badge {
            background: linear-gradient(135deg, var(--activity-primary) 0%, var(--activity-secondary) 100%);
            color: white;
            font-weight: var(--font-weight-semibold);
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-size: 0.875rem;
            box-shadow: var(--shadow-sm);
            border: 2px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .meal-icon, .activity-icon {
            width: 28px;
            height: 28px;
            padding: 6px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .meal-icon:hover, .activity-icon:hover {
            transform: scale(1.1);
            box-shadow: var(--shadow-md);
        }

        .section-header {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-sm);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .meal-section .section-header {
            border-bottom: 3px solid transparent;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        }

        .meal-section .section-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--meal-primary) 0%, var(--meal-secondary) 100%);
        }

        .activity-section .section-header {
            border-bottom: 3px solid transparent;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        }

        .activity-section .section-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--activity-primary) 0%, var(--activity-secondary) 100%);
        }

        .section-header h4 {
            font-weight: var(--font-weight-bold);
            color: #2d3748;
            margin-bottom: 0.5rem;
            font-size: 1.5rem;
        }

        .section-header p {
            color: #718096;
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: var(--font-weight-medium);
        }

        .activity-item {
            background: linear-gradient(135deg, rgba(0, 123, 255, 0.1) 0%, rgba(111, 66, 193, 0.1) 100%);
            border: 1px solid rgba(0, 123, 255, 0.2);
            border-radius: 2rem;
            padding: 0.5rem 1rem;
            margin: 0.25rem;
            display: inline-block;
            font-size: 0.875rem;
            font-weight: var(--font-weight-medium);
            transition: var(--transition);
            backdrop-filter: blur(5px);
        }

        .activity-item:hover {
            background: linear-gradient(135deg, rgba(0, 123, 255, 0.2) 0%, rgba(111, 66, 193, 0.2) 100%);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        .highlighted-activity {
            background: linear-gradient(135deg, var(--activity-primary) 0%, var(--activity-secondary) 100%);
            color: white;
            border-color: transparent;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-weight: var(--font-weight-bold);
            color: #2d3748;
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }

        .card-text {
            font-weight: var(--font-weight-semibold);
            color: #4a5568;
            font-size: 1rem;
            margin-bottom: 0.75rem;
        }

        .text-muted.small {
            color: #718096 !important;
            font-size: 0.875rem;
            font-style: italic;
            font-weight: var(--font-weight-medium);
        }

        .badge.bg-primary {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%) !important;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-size: 0.875rem;
            font-weight: var(--font-weight-semibold);
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .badge.bg-primary:hover {
            background: linear-gradient(135deg, #495057 0%, #343a40 100%) !important;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .badge.bg-success {
            background: linear-gradient(135deg, var(--meal-primary) 0%, var(--meal-secondary) 100%) !important;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-size: 0.875rem;
            font-weight: var(--font-weight-semibold);
            box-shadow: var(--shadow-sm);
            cursor: default;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(40, 167, 69, 0); }
            100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
        }

        .alert.alert-info {
            background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
            border: 1px solid #b6d4da;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
            padding: 1.5rem;
        }

        .alert.alert-info::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, #0dcaf0 0%, #0891b2 100%);
        }

        .alert.alert-info .d-flex {
            align-items: center;
        }

        .alert.alert-info strong {
            font-weight: var(--font-weight-bold);
            color: #055160;
        }

        .alert.alert-info div {
            color: #0c5460;
            font-weight: var(--font-weight-medium);
        }

        .btn.btn-primary {
            background: linear-gradient(135deg, var(--activity-primary) 0%, var(--activity-secondary) 100%);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 3rem;
            font-size: 1.125rem;
            font-weight: var(--font-weight-semibold);
            transition: var(--transition);
            box-shadow: var(--shadow-md);
            min-width: 250px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn.btn-primary:hover {
            background: linear-gradient(135deg, #0056b3 0%, #5a2d91 100%);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn.btn-primary:active {
            transform: translateY(0);
        }

        form {
            display: inline-block;
        }

        button[type="submit"] {
            cursor: pointer;
            transition: var(--transition);
        }

        .d-flex.align-items-center.gap-2 {
            gap: 0.75rem !important;
        }

        .me-auto {
            margin-right: auto !important;
        }

        .fw-semibold {
            font-weight: var(--font-weight-semibold) !important;
        }

        .mb-2 {
            margin-bottom: 0.75rem !important;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
        }

        .mb-5 {
            margin-bottom: 2rem !important;
        }

        .mt-5 {
            margin-top: 2rem !important;
        }

        .shadow-sm {
            box-shadow: var(--shadow-sm) !important;
        }

        .border-0 {
            border: none !important;
        }

        /* Enhanced responsive design */
        @media (max-width: 1200px) {
            .container-fluid {
                padding: 1.5rem;
            }
        }

        @media (max-width: 992px) {
            .section-header {
                padding: 1.25rem;
                margin-bottom: 1.5rem;
            }
            
            .card-body {
                padding: 1.25rem;
            }
            
            .section-header h4 {
                font-size: 1.375rem;
            }
        }

        @media (max-width: 768px) {
            .container-fluid {
                padding: 1rem;
            }
            
            .section-header {
                padding: 1rem;
                margin-bottom: 1.25rem;
            }
            
            .card-body {
                padding: 1rem;
            }
            
            .section-header h4 {
                font-size: 1.25rem;
            }
            
            .card-title {
                font-size: 1.125rem;
            }
            
            .btn.btn-primary {
                min-width: 200px;
                padding: 0.875rem 1.5rem;
                font-size: 1rem;
            }
            
            .time-badge, .activity-badge {
                padding: 0.375rem 0.75rem;
                font-size: 0.8125rem;
            }
        }

        @media (max-width: 576px) {
            .container-fluid {
                padding: 0.75rem;
            }
            
            .activity-item {
                display: block;
                margin: 0.25rem 0;
                text-align: center;
                width: 100%;
            }
            
            .d-flex.align-items-center.gap-2 {
                flex-wrap: wrap;
                gap: 0.5rem !important;
            }
            
            .time-badge, .activity-badge {
                margin-top: 0.5rem;
                width: 100%;
                text-align: center;
            }
            
            .me-auto {
                margin-right: 0 !important;
                width: 100%;
            }
            
            .section-header h4 {
                font-size: 1.125rem;
            }
            
            .card-title {
                font-size: 1rem;
            }
            
            .btn.btn-primary {
                width: 100%;
                min-width: auto;
            }
        }

        /* Smooth animations */
        .meal-card, .activity-card, .section-header, .alert {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Enhanced focus states for accessibility */
        .badge.bg-primary:focus,
        .btn.btn-primary:focus {
            outline: 2px solid #0056b3;
            outline-offset: 2px;
        }

        /* Improved hover states */
        .meal-card:hover .meal-icon,
        .activity-card:hover .activity-icon {
            transform: scale(1.1) rotate(5deg);
        }

        /* Better text contrast */
        .card-text.fw-semibold {
            color: #2d3748;
        }

        .text-muted {
            color: #718096 !important;
        }

        /* Enhanced button states */
        button[type="submit"]:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Improved spacing for better visual hierarchy */
        .col-lg-6 {
            padding: 0 1rem;
        }

        @media (max-width: 992px) {
            .col-lg-6 {
                padding: 0 0.5rem;
                margin-bottom: 2rem;
            }
        }
    </style>

@if($plan)
@if($plan->created_at->isToday())
    <div class="container-fluid py-4">
        <div class="row g-4">
            <!-- Daily Meal Schedule -->
            <div class="col-lg-6">
                <div class="meal-section">
                    <div class="section-header">
                        <h4 class=" mb-2">
                            <svg class="meal-icon me-2" viewBox="0 0 24 24">
                                <path d="M8.1 13.34l2.83-2.83L3.91 3.5c-1.56 1.56-1.56 4.09 0 5.66l4.19 4.18zm6.78-1.81c1.53.71 3.68.21 5.27-1.38 1.91-1.91 2.28-4.65.81-6.12-1.46-1.46-4.20-1.10-6.12.81-1.59 1.59-2.09 3.74-1.38 5.27L3.7 19.87l1.41 1.41L12 14.41l6.88 6.88 1.41-1.41L13.41 13l1.47-1.47z"/>
                            </svg>
                            Daily Meal Schedule
                        </h4>
                        <p class="text-muted mb-0">Optimized timing for balanced blood sugar</p>
                    </div>
                    <!-- Breakfast -->
                    <div class="card meal-card border-0 shadow-sm mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <img src="https://img.icons8.com/?size=100&id=3p9396WYR1fJ&format=png&color=000000" style="height:25px;" />
                                <h5 class="card-title mb-0 me-auto">Breakfast</h5>
                                <span class="badge time-badge">{{ $result->daily_meal_plan->breakfast->time }}</span>
                            </div>
                            <p class="card-text fw-semibold mb-2">{{ $result->daily_meal_plan->breakfast->food }}</p>
                            <p class="text-muted small mb-0">{{ $result->daily_meal_plan->breakfast->food_class }}</p>
                            @if($result->daily_meal_plan->breakfast->marked_by_user != 'yes')
                            <form action="{{ route('update_result', $plan->id) }}" method="POST">
                                @csrf
                            <input value="{{  $result->daily_meal_plan->breakfast->marked_by_user }}" name="breakfast_mark" hidden />
                            <button type="submit" class="badge bg-primary">Mark Done</button>
                            </form>
                            @else
                            <button class="badge bg-success">Complete</button>
                            @endif
                        </div>
                    </div>
                    <!-- Mid-Morning Snack -->
                    <div class="card meal-card border-0 shadow-sm mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <img src="https://img.icons8.com/?size=100&id=16006&format=png&color=000000" style="height:25px;" />
                                <h5 class="card-title mb-0 me-auto">Mid-Morning Snack</h5>
                                <span class="badge time-badge">{{ $result->daily_meal_plan->mid_breakfast->time}}</span>
                            </div>
                            <p class="card-text fw-semibold mb-2">{{ $result->daily_meal_plan->mid_breakfast->food}}</p>
                            <p class="text-muted small mb-0">{{ $result->daily_meal_plan->mid_breakfast->food_class}}</p>
                            @if($result->daily_meal_plan->mid_breakfast->marked_by_user != 'yes')
                            <form action="{{ route('update_result', $plan->id) }}" method="POST">
                                @csrf
                            <input value="{{  $result->daily_meal_plan->mid_breakfast->marked_by_user }}" name="mid_breakfast_mark" hidden />
                            <button type="submit" class="badge bg-primary">Mark Done</button>
                            </form>
                            @else
                            <button class="badge bg-success">Complete</button>
                            @endif
                        </div>
                    </div>
                    <!-- Lunch -->
                    <div class="card meal-card border-0 shadow-sm mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-2 mb-2">
                               <img src="https://img.icons8.com/?size=100&id=Wo1qvcAZ4Z62&format=png&color=000000" style="height:25px;" />
                                <h5 class="card-title mb-0 me-auto">Lunch</h5>
                                <span class="badge time-badge">{{ $result->daily_meal_plan->lunch->time}}</span>
                            </div>
                            <p class="card-text fw-semibold mb-2">{{ $result->daily_meal_plan->lunch->food }}</p>
                            <p class="text-muted small mb-0">{{ $result->daily_meal_plan->lunch->food_class }}</p>
                            @if($result->daily_meal_plan->lunch->marked_by_user != 'yes')
                           <form action="{{ route('update_result', $plan->id) }}" method="POST">
                                @csrf
                            <input value="{{  $result->daily_meal_plan->lunch->marked_by_user }}" name="lunch_mark" hidden />
                            <button type="submit" class="badge bg-primary">Mark Done</button>
                           </form>
                            @else
                            <button class="badge bg-success">Complete</button>
                            @endif
                        </div>
                    </div>
                    <!-- Afternoon Snack -->
                    <div class="card meal-card border-0 shadow-sm mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <img src="https://img.icons8.com/?size=100&id=j8qUiD3hNws0&format=png&color=000000" style="height:25px;" />
                                <h5 class="card-title mb-0 me-auto">Afternoon Snack</h5>
                                <span class="badge time-badge">{{$result->daily_meal_plan->afternoon_snack->time}}</span>
                            </div>
                            <p class="card-text fw-semibold mb-2">{{ $result->daily_meal_plan->afternoon_snack->food }}</p>
                            <p class="text-muted small mb-0">{{ $result->daily_meal_plan->afternoon_snack->food_class }}</p>
                            @if($result->daily_meal_plan->afternoon_snack->marked_by_user != 'yes')
                            <form action="{{ route('update_result', $plan->id) }}" method="POST">
                                @csrf
                            <input value="{{  $result->daily_meal_plan->afternoon_snack->marked_by_user }}" name="afternoon_snack_mark" hidden />
                            <button type="submit" class="badge bg-primary">Mark Done</button>
                            </form>
                            @else
                            <button class="badge bg-success">Complete</button>
                            @endif
                        </div>
                    </div>
                    <!-- Dinner -->
                    <div class="card meal-card border-0 shadow-sm mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <img src="https://img.icons8.com/?size=100&id=lQa13dV8Qrwg&format=png&color=000000" style="height:25px;" />
                                <h5 class="card-title mb-0 me-auto">Dinner</h5>
                                <span class="badge time-badge">{{ $result->daily_meal_plan->dinner->time}}</span>
                            </div>
                            <p class="card-text fw-semibold mb-2">{{$result->daily_meal_plan->dinner->food}}</p>
                            <p class="text-muted small mb-0">{{ $result->daily_meal_plan->dinner->food_class }}</p>
                            @if($result->daily_meal_plan->dinner->marked_by_user != 'yes')
                            <form action="{{ route('update_result', $plan->id) }}" method="POST">
                                @csrf
                            <input value="{{  $result->daily_meal_plan->dinner->marked_by_user }}" name="dinner_mark" hidden />
                            <button type="submit" class="badge bg-primary">Mark Done</button>
                            </form>
                            @else
                            <button class="badge bg-success">Complete</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Physical Activity Plan -->
            <div class="col-lg-6">
                <div class="activity-section">
                    <div class="section-header">
                        <h4 class="mb-2">
                            <img src="https://img.icons8.com/?size=100&id=916&format=png&color=000000" style="height:25px;" />
                            Physical Activity Plan
                        </h4>
                        <p class="text-muted mb-0">Activities to help manage blood sugar levels</p>
                    </div>
                    <!-- Aerobic Exercise -->
                    <div class="card activity-card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3 gap-2">
                                <img src="https://img.icons8.com/?size=100&id=lWxomrjfCAvF&format=png&color=000000" style="height:25px;" />
                                <h5 class="card-title mb-0 me-auto">Aerobic Exercise</h5>
                                <span class="badge activity-badge">{{ $result->physical_activity->aerobic_exercise->walk }}</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <span class="activity-item">{{ $result->physical_activity->aerobic_exercise->action_1 }}</span>
                                <span class="activity-item">{{ $result->physical_activity->aerobic_exercise->action_2 }}</span>
                                <span class="activity-item">{{ $result->physical_activity->aerobic_exercise->action_3 }}</span>
                            </div>
                               @if($result->physical_activity->aerobic_exercise->marked_by_user != 'yes')
                               <form action="{{ route('update_result', $plan->id) }}" method="POST">
                                @csrf
                                <input value="{{  $result->physical_activity->aerobic_exercise->marked_by_user }}" name="aerobic_mark" hidden />
                                <button type="submit" class="badge bg-primary">Mark Done</button>
                               </form>
                                @else
                                <button class="badge bg-success">Complete</button>
                                @endif
                        </div>
                    </div>
                    <!-- Strength Training -->
                    <div class="card activity-card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://img.icons8.com/?size=100&id=hTHAYPHiE9Ze&format=png&color=000000" style="height:25px;" />
                                <h5 class="card-title mb-0 me-auto">Strength Training</h5>
                                <span class="badge activity-badge">{{ $result->physical_activity->strength_training->duration }}</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <span class="activity-item">{{ $result->physical_activity->strength_training->action_1 }}</span>
                                <span class="activity-item">{{ $result->physical_activity->strength_training->action_2 }}</span>
                                <span class="activity-item">{{ $result->physical_activity->strength_training->action_3 }}</span>
                            </div>
                             @if($result->physical_activity->strength_training->marked_by_user != 'yes')
                             <form action="{{ route('update_result', $plan->id) }}" method="POST">
                                @csrf
                                   <input value="{{  $result->physical_activity->strength_training->marked_by_user }}" name="strength_training_mark" hidden />
                                <button type="submit" class="badge bg-primary">Mark Done</button>
                             </form>
                                @else
                                <button class="badge bg-success">Complete</button>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="alert alert-info border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <svg class="me-2" width="20" height="20" viewBox="0 0 24 24" fill="#0dcaf0">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        <div>
                            <strong>Diabetes Status:</strong>
                             {{ $result?->diabetes_status }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <form action="{{ route('ai_result') }}" method="POST" class="container-fluid py-4 row justify-content-center">
        @csrf
        <input value="{{ $plan->id }}" type="result" hidden />
        <button type="submit" class="btn btn-primary mt-5 col-3"> Generate Today Plan </button>
      </form>
     @endif
         <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

@endif
@endsection
