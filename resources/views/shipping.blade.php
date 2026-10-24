@extends('layouts.app')
@section('title', 'Redemption ID #'.$certificate->certid)
@section('content')
<section class="container">
<div class="content">

    <h1>Redemption ID — #{{$certificate->certid}}</h1>
    <br>


    <br>
    <br>

    <div class="section-row">
            <div class="section-rebate dropShadow margin displayFlex"> 
                <div class="submissionHeadings displayFlex">
                    <h2>Customer Billing Info</h2>
                    <div class="header-side">
                        <p><a href="{{url('/certificates/shipping/'.$certificate->certid.'/generate')}}">Shipping Label</a></p>
                    </div>
                
                </div>
                <div>
                    <div class="flex-row">
                        <div class="flex-row-item">
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>Full Name</strong></p>
                                <p class="p50">{{$certificate->author->fname}} {{$certificate->author->lname}}</p>
                            </div>
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>Phone Number</strong></p>
                                <p class="p50">{{$certificate->author->phone}}</p>
                            </div>
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>Email Address</strong></p>
                                <p class="p50">{{$certificate->author->email}}</p>
                            </div>
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>Company</strong></p>
                                <p class="p50">{{$certificate->author->company}}</p>
                            </div>

                        </div>
        
                        <div class="flex-row-item">
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>Address</strong></p>
                                <p class="p50">{{$certificate->author->address}}</p>
                            </div>
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>City</strong></p>
                                <p class="p50">{{$certificate->author->city}}</p>
                            </div>
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>Postal</strong></p>
                                <p class="p50">{{$certificate->author->postal}}</p>
                            </div>
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>Profession</strong></p>
                                <p class="p50">{{$certificate->author->profession}}</p>
                            </div>
                        </div>
        </div>
                    
                </div>
            </div>

            
                </div>
<div class="section-row">
        <div class="section-rebate dropShadow payment-info-container margin"> 
            <div class="submissionHeadings displayFlex">
                <h2>Redeemed Product</h2>
            </div>

            <div class="flex-row">
                <div class="flex-row-item">
                    <div class="displayFlex padding borderGray">
                        <p class="p50"><strong>Redeemed Product</strong></p>
                        <p class="p50">{{$certificate->reward->name}}@if($certificate->option) (Model: {{$certificate->option->model}})@endif</p>
                    </div>


                </div>

                <div class="flex-row-item">
                    <div class="displayFlex padding borderGray">
                        <p class="p50"><strong>Redeemed Value</strong></p>
                        <p class="p50">${{$certificate->value}}</p>
                    </div>

                </div>
</div>


            <form class='dropShadow standard-form' name='payment-form' method="POST" action="{{ url('update-shipping') }}/{{ $certificate->certid }}">
                @csrf
                <div class=" payment-item-container">
                <div class='flex-row-item'>
                    <label for="status">Shipping Status:</label>
                    <select name="status" id="status">
                            <option @if ($certificate->shipped == 0) {{ 'selected' }} @endif value="0">Not Shipped</option>
                            <option @if ($certificate->shipped == 1) {{ 'selected' }} @endif value="1">Shipped</option>
                    </select>
                </div>
        
                <div class='flex-row-item'>
                    <label for="tracking">Tracking Number:</label>
                    <input type="number" step="any" placeholder="Tracking Number" value='{{ $certificate->tracking }}' name='tracking'>          
                </div>
        
        
            </div>
        

            </div>
        
        
        <br>
            <input class='payment-submission small-submit-button' type="submit" value="Update Redemption">
        
        </form>

</div>



</section>
@endsection