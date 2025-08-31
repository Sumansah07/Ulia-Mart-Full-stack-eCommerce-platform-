@extends('layouts.auth')

@section('title')
    {{ localize('Reset Password') }}
@endsection

@section('contents')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf

                            <h4 class="mb-3">{{ localize('Reset Password') }}</h4>
                            <p class="text-muted mb-4">{{ localize('Enter your email address below. You will receive a link to reset your password.') }}</p>

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <input type="hidden" name="reset_with" class="reset_with" value="email">

                            <div class="mb-3">
                                <span class="reset-email @if (old('reset_with') == 'phone') d-none @endif">
                                    <label class="form-label">{{ localize('Email') }}</label>
                                    <input type="email" id="email" name="email"
                                        placeholder="your@email.com"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" required>

                                    <small class="mt-1 d-block">
                                        <a href="javascript:void(0);" class="reset-with-phone-btn"
                                            onclick="handleResetWithPhone()">
                                            {{ localize('Reset with phone?') }}</a>
                                    </small>
                                </span>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <span class="reset-phone @if (old('reset_with') == 'email' || old('reset_with') == '') d-none @endif">
                                    <label class="form-label">{{ localize('Phone') }}</label>
                                    <input type="text" id="phone" name="phone" placeholder="+xxxxxxxxxx"
                                        class="form-control" value="{{ old('phone') }}">

                                    <small class="mt-1 d-block">
                                        <a href="javascript:void(0);" class="reset-with-email-btn"
                                            onclick="handleResetWithEmail()">
                                            {{ localize('Reset with email?') }}</a>
                                    </small>
                                </span>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success w-100"
                                    style="background-color: #198754; border-color: #198754;">
                                    {{ localize('Send Reset Link') }}
                                </button>
                            </div>

                            <div class="text-center">
                                <a href="javascript:void(0);" class="text-success fw-bold" onclick="backToLogin()">
                                    <i class="fas fa-arrow-left me-1"></i> {{ localize('Back to Login') }}
                                </a>
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

        // Back to login page
        function backToLogin() {
            window.location.href = "{{ route('login') }}";
        }

        // change input to phone
        function handleResetWithPhone() {
            $('.reset_with').val('phone');

            $('.reset-email').addClass('d-none');
            $('.reset-email input').prop('required', false);

            $('.reset-phone').removeClass('d-none');
            $('.reset-phone input').prop('required', true);
        }

        // change input to email
        function handleResetWithEmail() {
            $('.reset_with').val('email');
            $('.reset-email').removeClass('d-none');
            $('.reset-email input').prop('required', true);

            $('.reset-phone').addClass('d-none');
            $('.reset-phone input').prop('required', false);
        }
    </script>
@endsection
