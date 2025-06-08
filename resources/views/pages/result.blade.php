@extends('shared.layout')
@section('content')
    <style>
        .meal-card {
            background: linear-gradient(135deg, #e8f5e8 0%, #f0f9f0 100%);
            border-left: 4px solid #28a745;
        }
        .activity-card {
            background: linear-gradient(135deg, #e3f2fd 0%, #f3f8ff 100%);
            border-left: 4px solid #007bff;
        }
        .time-badge {
            background-color: #28a745;
            color: white;
            font-weight: 600;
        }
        .activity-badge {
            background-color: #007bff;
            color: white;
            font-weight: 600;
        }
        .meal-icon {
            fill: #28a745;
            width: 20px;
            height: 20px;
        }
        .activity-icon {
            fill: #007bff;
            width: 20px;
            height: 20px;
        }
        .section-header {
            border-bottom: 3px solid #dee2e6;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .meal-section .section-header {
            border-bottom-color: #28a745;
        }
        .activity-section .section-header {
            border-bottom-color: #007bff;
        }
        .activity-item {
            background-color: rgba(0, 123, 255, 0.1);
            border-radius: 20px;
            padding: 0.4rem 0.8rem;
            margin: 0.2rem;
            display: inline-block;
            font-size: 0.9rem;
        }
        .highlighted-activity {
            background-color: #007bff;
            color: white;
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
                                <span class="badge activity-badge">{{ $result->physical_activity->aerobic_excercise->walk }}</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <span class="activity-item">{{ $result->physical_activity->aerobic_excercise->action_1 }}</span>
                                <span class="activity-item">{{ $result->physical_activity->aerobic_excercise->action_2 }}</span>
                                <span class="activity-item">{{ $result->physical_activity->aerobic_excercise->action_3 }}</span>
                             
                            </div>
                               @if($result->physical_activity->aerobic_excercise->marked_by_user != 'yes')
                               <form action="{{ route('update_result', $plan->id) }}" method="POST">
                                @csrf 
                               <input value="{{  $result->physical_activity->aerobic_excercise->marked_by_user }}" name="aerobic_mark" hidden />
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
                                <span class="badge activity-badge">{{ $result->physical_activity->strength_tranning->duration }}</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <span class="activity-item">{{ $result->physical_activity->strength_tranning->action_1 }}</span>
                                <span class="activity-item">{{ $result->physical_activity->strength_tranning->action_2 }}</span>
                                <span class="activity-item">{{ $result->physical_activity->strength_tranning->action_3 }}</span>
                                
                            </div>
                             @if($result->physical_activity->strength_tranning->marked_by_user != 'yes')
                             <form action="{{ route('update_result', $plan->id) }}" method="POST">
                                @csrf   
                                <input value="{{  $result->physical_activity->strength_tranning->marked_by_user }}" name="strength_tranning_mark" hidden />
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
                            <strong>Diabeties Status:</strong> 
                            {{ $result?->daibeties_status }}
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
@endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

@endsection