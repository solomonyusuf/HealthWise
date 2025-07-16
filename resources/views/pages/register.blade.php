
@extends('shared.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-5">
            <div class="card auth-card border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-primary">Create Account</h2>
                        <p class="text-muted">Join us today</p>
                    </div>

                    <form method="POST" enctype="multipart/form-data" action="{{ route('post_register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Image</label>
                            <input type="file" class="form-control" 
                                   name="image"required>
                          
                        </div>
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">First Name</label>
                            <input id="name" type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                   name="first_name" value="{{ old('first_name') }}" required autocomplete="name" autofocus>
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Last Name</label>
                            <input id="name" type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                   name="last_name" value="{{ old('last_name') }}" required autocomplete="name" autofocus>
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" 
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </div>

                        <hr class="my-4">

                        <div class="text-center">
                            <p class="text-muted">Already have an account?</p>
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">
                                Sign In
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection