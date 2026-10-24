<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Reset Password - 3M ASD Tool Up Program</title>

    @include('partials.favicon')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
</head>
<body>
<div class="login-container">
    <div class="login-form">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <img class="logo" src="{{ asset('images/3m-logo-black.svg') }}" alt="3M Logo">
            <h1>3M Trade Up <br><small>ASD Tool Up Program</small></h1>
            <h2>Reset Password</h2>

            <p class="login-help">Choose a new password for your account.</p>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-input-container">
                <label for="email">{{ __('E-Mail Address') }}</label>
                <div>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email Address" name="email" value="{{ old('email', $email) }}" required autofocus>
                </div>
            </div>

            <div class="form-input-container">
                <label for="password">{{ __('Password') }}</label>
                <div>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required>
                </div>
            </div>

            <div class="form-input-container">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <div>
                    <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                </div>
            </div>

            <div class="submit-container">
                <button type="submit">
                    {{ __('Reset Password') }}
                </button>

                <a class="btn btn-link" href="{{ route('login') }}">
                    Back to Login
                </a>
            </div>
        </form>
    </div>
    <div class="background-banner"></div>
</div>
</body>
</html>
