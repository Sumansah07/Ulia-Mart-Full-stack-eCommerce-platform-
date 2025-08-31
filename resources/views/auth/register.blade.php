@extends('layouts.auth')

@push('head')
@endpush


@section('title')
    {{ localize('Sign Up') }}
@endsection


@section('contents')
<style>
    .form-label {
        color: #198754 !important;
    }
</style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white p-0">
                        <ul class="nav nav-tabs nav-fill">
                            <li class="nav-item">
                                <a class="nav-link active py-3" href="{{ route('register') }}">{{ localize('Register') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3" href="{{ route('login') }}">{{ localize('Login') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('register') }}" method="POST" id="login-form">
                            @csrf
                            @if (getSetting('enable_recaptcha') == 1)
                                {!! RecaptchaV3::field('recaptcha_token') !!}
                            @endif

                            <h4 class="mb-3">{{ localize('Create an Account') }}</h4>
                            <p class="text-muted mb-4">{{ localize('Enter your details to create a new account') }}</p>

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="form-label">{{ localize('First Name') }}<sup class="text-danger">*</sup></label>
                                    <input type="text" name="name" class="form-control" placeholder="{{ localize('First Name') }}" value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ localize('Last Name') }}</label>
                                    <input type="text" name="last_name" class="form-control" placeholder="{{ localize('Last Name') }}" value="{{ old('last_name') }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ localize('Email') }}<sup class="text-danger">*</sup></label>
                                <input type="email" name="email" class="form-control" placeholder="your@email.com" value="{{ old('email') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">
                                    @if (getSetting('registration_with') == 'email_and_phone')
                                        {{ localize('Phone') }}<sup class="text-danger">*</sup>
                                    @else
                                        {{ localize('Phone') }}
                                    @endif
                                </label>
                                <input type="text" name="phone" class="form-control" placeholder="+xxxxxxxxxx" value="{{ old('phone') }}"
                                    @if (getSetting('registration_with') == 'email_and_phone') required @endif>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ localize('Password') }}<sup class="text-danger">*</sup></label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">{{ localize('Confirm Password') }}<sup class="text-danger">*</sup></label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="••••••••" required>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success w-100 sign-in-btn"
                                    style="background-color: #198754; border-color: #198754;"
                                    onclick="handleSubmit()">
                                    {{ localize('Create Account') }}
                                </button>
                            </div>

                            <div class="text-center mt-4">
                                <p>{{ localize('Already have an account?') }}
                                    <a href="javascript:void(0);" class="text-success fw-bold" onclick="switchToLogin()">
                                        {{ localize('Login here') }}
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        "use strict";

        // Switch to login page
        function switchToLogin() {
            window.location.href = "{{ route('login') }}";
        }

        // disable login button
        function handleSubmit() {
            $('#login-form').on('submit', function(e) {
                $('.sign-in-btn').prop('disabled', true);
            });
        }
    </script>
@endsection
