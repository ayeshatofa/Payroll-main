{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="col-md-6 col-lg-5 bg-white p-5 rounded shadow-lg border border-2 border-pink">
        <h2 class="text-center text-pink fw-bold mb-4">{{ __('Login') }}</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold text-pink">Email Address</label>
                <input id="email" type="email" class="form-control border-pink" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold text-pink">Password</label>
                <input id="password" type="password" class="form-control border-pink" name="password" required>
                @error('password')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="mb-3 form-check">
                <input class="form-check-input border-pink" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label text-pink" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-pink w-100 py-2 fw-bold">
                    {{ __('Login') }}
                </button>
            </div>

            <!-- Forgot Password Link -->
            @if (Route::has('password.request'))
                <div class="text-center mt-3">
                    <a class="text-pink text-decoration-none fw-semibold" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>

<!-- Bootstrap Included (If Not Already in Layout) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom Pink Theme -->
<style>
    .bg-light { background-color: #ffe6f2 !important; } /* Light pink background */
    .border-pink { border-color: #ff66b2 !important; } /* Pink border */
    .text-pink { color: #ff3385 !important; } /* Text color */
    .btn-pink {
        background-color: #ff3385 !important; /* Dark Pink Button */
        border-color: #ff3385 !important;
        color: white !important;
    }
    .btn-pink:hover {
        background-color: #e60073 !important; /* Slightly darker pink on hover */
    }
    .form-control:focus {
        border-color: #ff66b2 !important; /* Pink border focus */
        box-shadow: 0 0 5px rgba(255, 51, 133, 0.5) !important;
    }
</style>
@endsection

