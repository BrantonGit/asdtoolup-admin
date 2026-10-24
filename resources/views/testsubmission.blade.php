@extends('layouts.app')

@section('content')
<section class="container">
<div class="content">
<h1>Submission testing is no longer being shown here.</h1>
<p>Please use the client side to submit new rebate submissions.</p>
<p><a href='https://branton.ca/dev/3m-tradeup/#/'>Click here to view client side</a></p>
    <!-- <div class="create-form-head">
<h1>Create Submission (Test Example)</h1>
    <p>Please note: <strong>This submission form is strictly for testing purposes only.</strong> In production, submissions will be created from the client side version and customers will NEVER access this panel.</p>
    </div>
    <div class="card-body">
                    <form class='dropShadow standard-form' method="POST" enctype="multipart/form-data" action="{{ route('testSubmit') }}">

                        @csrf
                         @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li><span class="invalid-feedback" role="alert">{{ $error }}</span></li>
            @endforeach
        </ul>
    </div>
@endif  
                        <h2>Receipt Section</h2>
                       
                        <div class="form-group row">
                            <label for="receipt">{{ __('Receipt Photo') }}</label>
                            <div>
                                <input id="receipt" multiple="multiple" type="file" class="form-control{{ $errors->has('receipt') ? ' is-invalid' : '' }}" name="receipt[]" value="{{ old('receipt') }}" autofocus>
                                @if ($errors->has('receipt'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('receipt') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr><h2>Trade In Section</h2>
                        <div class="form-group row">
                            <label for="tradein">{{ __('Tradein Photo') }}</label>
                            <div>
                                <input id="tradein" multiple="multiple" type="file" class="form-control{{ $errors->has('tradein') ? ' is-invalid' : '' }}" name="tradein[]" value="{{ old('tradein') }}" autofocus>
                                @if ($errors->has('tradein'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tradein') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                        </div>

                        <hr><h2>Tool Up Section</h2>
                        <div class="form-group row">
                            <label for="tradeup">{{ __('Tradeup Photo') }}</label>
                            <p>Three products are chosen at random for testing. In production, the user will select the products.</p>
                            @for($i = 0; $i < sizeof($products); $i++)
                            <h3 style='margin-top: 20px'>Product #{{$products[$i]->id}}</h3>
                            <input name="tradeup[{{$i}}][prodid]" value="{{$products[$i]->id}}">
                            <input name="tradeup[{{$i}}][quantity]" value="" placeholder="quantity">
                            @endfor
                            </div>

                        <hr> <h2>Customer Info</h2>
                        <div class="form-group row">
                            <label for="fname">{{ __('Your First Name') }}</label>
                            <div>
                                <input id="fname" type="type" class="form-control{{ $errors->has('fname') ? ' is-invalid' : '' }}" name="fname" value="{{ old('fname') }}" autofocus>
                                @if ($errors->has('fname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lname') }}</strong>

                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lname">{{ __('Your Last Name') }}</label>
                            <div>
                                <input id="lname" type="type" class="form-control{{ $errors->has('lname') ? ' is-invalid' : '' }}" name="lname" value="{{ old('lname') }}" autofocus>
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
                            <input id="email" type="type" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="company">{{ __('Your Company') }}</label>
                            <div>
                            <input id="company" type="type" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company" value="{{ old('company') }}" autofocus>
                                @if ($errors->has('company'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profession">{{ __('Your Profession') }}</label>
                            <div>
                            <input id="profession" type="type" class="form-control{{ $errors->has('profession') ? ' is-invalid' : '' }}" name="profession" value="{{ old('profession') }}" autofocus>
                                @if ($errors->has('profession'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('profession') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="phone">{{ __('Your Phone Number') }}</label>
                            <div>
                                <input id="phone" type="type" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="51974234833" autofocus>
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
                                <input id="address" type="type" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="1057 Oxford St. West" autofocus>
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
                                <input id="city" type="type" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="London" autofocus>
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
                                <input id="postal" type="type" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="postal" value="N6P 1A4" autofocus>
                                @if ($errors->has('postal'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('postal') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <button type="submit" class="submit-button">
                            {{ __('Create Rebate') }}
                        </button>

                    </form>
                </div> -->


</div>
</section>
@endsection
