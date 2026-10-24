@extends('layouts.app')

<!-- @section('content') -->
<div class="container">
    <div class="content">
        <div class="col-md-8">
            <div class="card">
                <h1>Register</h1>
                <p>Please Note: This is for test purposes only. Users WILL NOT be able to register or access this panel. Additionally, we will manually create admin users. </p>
                <br>
                <div class="card-body">
                    <form class='dropShadow standard-form' method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="fname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="fname" type="text" class="form-control{{ $errors->has('fname') ? ' is-invalid' : '' }}" name="fname" value="{{ old('fname') }}" required autofocus>

                                @if ($errors->has('fname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="lname" type="text" class="form-control{{ $errors->has('lname') ? ' is-invalid' : '' }}" name="lname" value="{{ old('lname') }}" required autofocus>

                                @if ($errors->has('lname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

        <div class='form-group'>
            <label for="address">My Address</label>
            <input required type="text" name='address' value="{{ old('address') }}">
        </div>
        <div class='form-group'>
            <label for="city">My City</label>
            <input required type="text" name="city" value="{{ old('city') }}">
        </div>
        <div class='form-group'>
            <label for="postal">Postal Code</label>
            <input required type="text" name='postal' value="{{ old('postal') }}">
        </div>
        <div class='form-group'>
            <label for="phone">Phone Number</label>
            <input required type="text" name="phone" value="{{ old('phone') }}">
        </div>
        <div class='form-group'>
            <label for="company">Company</label>
            <input required type="text" name="company" value="{{ old('company') }}">
        </div>
        <div class='form-group'>
            <label for="profession">Profession</label>
            <input required type="text" name="profession" value="{{ old('profession') }}">
        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select id="email" type="email" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role" value="{{ old('role') }}" required>
                                    <option value="0">User</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Master</option>
                                </select>
                                @if ($errors->has('role'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="small-submit-button">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
