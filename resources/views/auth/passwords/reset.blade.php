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
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <h4 class="mb-3">{{ localize('Set New Password') }}</h4>
                            <p class="text-muted mb-4">{{ localize('Create a new password for your account') }}</p>

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="mb-3">
                                <label class="form-label">{{ localize('Email') }}</label>
                                <input type="email" id="email" name="email"
                                    placeholder="your@email.com"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ $email ?? old('email') }}" required readonly>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ localize('New Password') }}<sup class="text-danger">*</sup></label>
                                <input type="password" name="password" id="password"
                                    placeholder="••••••••"
                                    class="form-control @error('password') is-invalid @enderror" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">{{ localize('Confirm New Password') }}<sup class="text-danger">*</sup></label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    placeholder="••••••••" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success w-100"
                                    style="background-color: #198754; border-color: #198754;">
                                    {{ localize('Reset Password') }}
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
    </script>
@endsection