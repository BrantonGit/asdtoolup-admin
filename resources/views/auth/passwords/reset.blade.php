<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Reset Password - 3M Trade In Tool Up</title>

    <!-- Scripts -->
    <script src="{{ asset('api/js/app.js') }}" defer></script>
    <link href="{{ asset('api/css/main.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
</head>
<body>
<div class="login-container">
                    <div class="login-form">
        
        
                    
                
                    <form method="POST"  action="{{url('/api/password/reset')}}">
                        @csrf
                        <img class='logo' src="{{ asset('/api/images/3m-logo-bw.svg')}}" alt="3M Logo">
                        <h1>Trade In Tool Up</h1>
                        <h2>Reset Your Password</h2>
  
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <input type="hidden" name="token" value="{{ $token }}">

                        <div class='form-input-container'>
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <div>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder='Email Address' name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class='form-input-container'>
                            <label for="password">{{ __('Password') }}</label>

                            <div>
                                <input id="password" type="password" placeholder='Password' class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class='form-input-container'>
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>

                            <div>
                                <input id="password-confirm" type="password" class="form-control" placeholder='Confirm Password' name="password_confirmation" required>
                            </div>
                        </div>

            
                        <div class='submit-container'>
                                <button type="submit-btn">
                                {{ __('Reset Password') }}
                                </button>

                    </form>
         
                    <div class="background-banner">

                    </div>

</div>
</body>
</html>



