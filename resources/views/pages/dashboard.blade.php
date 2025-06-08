@extends('shared.layout')
@section('content')
@php

  $result =  App\Http\Controllers\ChartController::generate_activity();

   
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
                                        <h6 class="mb-2 fw-bold text-lg mb-0">Glucose Tracker</h6>
                                    </div>
                                </div>
                                <div class="card-body p-24 d-flex align-items-center gap-16">
                                    <div id="radialMultipleBar"></div>
                                    <ul class="d-flex flex-column gap-12">
                                        <li>
                                            <span class="text-lg">Meal Plan Analytics: <span class="text-primary-600 fw-semibold">{{$result[0]}}%</span> </span>
                                        </li>
                                        <li>
                                            <span class="text-lg">Strength Tranning Analytics:  <span class="text-warning-600 fw-semibold">{{$result[1]}}%</span> </span>
                                        </li>
                                         
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                        <!-- Patient Visited by Depertment -->
                    </div>
                </div>
        
            </div>
    </div>
    
@endsection