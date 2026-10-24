@extends('layouts.app')

@section('content')
<section class="container">
<div class="content">
    <div>
        @switch($editType)
        @case("customer-info")
        <form method="POST" class='dropShadow standard-form' enctype="multipart/form-data" action="{{ route('customer-update', $submission->id) }}">
            @csrf
            
        <h2>{{ ucwords(str_replace('-', ' ', $editType)) }}</h2>
                        <div class="form-group row">
                            <label for="fname">{{ __('Your First Name') }}</label>
                            <div>
                            <input id="fname" type="type" class="form-control{{ $errors->has('fname') ? ' is-invalid' : '' }}" name="fname" value="{{ $submission->customerInfo->fname }}" autofocus>
                                @if ($errors->has('fname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fname') }}</strong>

                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lname">{{ __('Your Last Name') }}</label>
                            <div>
                            <input id="lname" type="type" class="form-control{{ $errors->has('lname') ? ' is-invalid' : '' }}" name="lname" value="{{ $submission->customerInfo->lname }}" autofocus>
                                @if ($errors->has('lname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lname') }}</strong>

                                    </span>
                                @endif
                            </div>
                        </div>

   
                            <div class="form-group row">
                            <label for="email">{{ __('Your Email') }}</label>
                            <div>
                                <input id="email" type="type" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="lucas@branton.ca" autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="phone">{{ __('Your Phone Number') }}</label>
                            <div>
                                <input id="phone" type="type" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $submission->customerInfo->phone }}" required autofocus>
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="address">{{ __('Your Address') }}</label>
                            <div>
                                <input id="address" type="type" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $submission->customerInfo->address }}" required autofocus>
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city">{{ __('Your City') }}</label>
                            <div>
                                <input id="city" type="type" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ $submission->customerInfo->city}}" required autofocus>
                                @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="postal">{{ __('Your Postal/Zip Code') }}</label>
                            <div>
                                <input id="postal" type="type" class="form-control{{ $errors->has('postal') ? ' is-invalid' : '' }}" name="postal" value="{{ $submission->customerInfo->postal }}" required autofocus>
                                @if ($errors->has('postal'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('postal') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="profession">{{ __('Your Profession') }}</label>
                            <div>
                                <input id="profession" type="type" class="form-control{{ $errors->has('profession') ? ' is-invalid' : '' }}" name="profession" value="{{ $submission->customerInfo->profession }}" required autofocus>
                                @if ($errors->has('profession'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('profession') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="company">{{ __('Your Company') }}</label>
                            <div>
                                <input id="company" type="type" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company" value="{{ $submission->customerInfo->company }}" required autofocus>
                                @if (count($errors) !== 0)
                                <span class="invalid-feedback" role="alert">
                                <strong>{{$errors->first()}}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <button type="submit" class='small-submit-button'>
                            {{ __('Submit') }}
                        </button>

        </form>
        @break

        @case("receipt-info")
        <form method="POST" class='dropShadow standard-form'  enctype="multipart/form-data" action="{{ route('receipt-update', $submission->id) }}">
            @csrf
               
                    <h2>Receipt Section</h2>
                        <div class="form-group row">
                            <label for="receipt">{{ __('Receipt Photo') }}</label>
                            <div>
                                <input id="receipt" multiple="multiple" type="file" class="form-control{{ $errors->has('receipt') ? ' is-invalid' : '' }}" name="receipt[]" value="{{ old('receipt') }}" autofocus>
                                @if (count($errors) !== 0)
                                <span class="invalid-feedback" role="alert">
                                <strong>{{$errors->first()}}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                <button type="submit" class='small-submit-button'>
                    {{ __('Submit') }}
                </button>

        </form>
        @break

        @case("trade-in-info")
        <form method="POST" class='dropShadow standard-form'  enctype="multipart/form-data" action="{{ route('tradein-update', $submission->id) }}">
            @csrf
        
                <h2>Trade In Section</h2>
                        <div class="form-group row">
                            <label for="tradein">{{ __('Tradein Photo') }}</label>
                            <div>
                                <input id="tradein" multiple="multiple" type="file" class="form-control{{ $errors->has('tradein') ? ' is-invalid' : '' }}" name="tradein[]" value="{{ old('tradein') }}" autofocus>
                                @if (count($errors) !== 0)
                                <span class="invalid-feedback" role="alert">
                                <strong>{{$errors->first()}}</strong>
                                </span>
                                @endif
                                </div>
                </div>

                <button type="submit" class='small-submit-button'>
                    {{ __('Submit') }}
                </button>
        </form>
        @break

        @case("trade-up-info")
        <form method="POST" class='dropShadow standard-form'  enctype="multipart/form-data" action="{{ route('tradeup-update', $submission->id) }}">
            @csrf

                <h2>Tool Up Section</h2>
                    <div class="form-group row">
                        <label for="tradeup">{{ __('TradeUp Photo') }}</label>
                        <div>
                            <input id="tradeup" multiple="multiple" type="file" class="form-control{{ $errors->has('tradeup') ? ' is-invalid' : '' }}" name="tradeup[]" value="{{ old('tradeup') }}" autofocus>
                            @if (count($errors) !== 0)
                                <span class="invalid-feedback" role="alert">
                                <strong>{{$errors->first()}}</strong>
                                </span>
                            @endif
                        </div>
                </div>


                <button class='small-submit-button' type="submit">
                    {{ __('Submit') }}
                </button>

        </form>
        @break

        @default
            <span>Something went wrong, please try again</span>
        @endswitch
        
    </div>
</div>
</section>
    
@endsection