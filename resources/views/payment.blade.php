@extends('layouts.app')
@section('title', 'Payment #'.$payment->id)
@section('content')
<section class="container">
<div class="content">

    <h1>Purchase Submission — #{{$payment->submission_id}}</h1>
    <br>
    <p><a href="{{url('/submissions/'.$payment->submission->id)}}">View Submission</a></p>

    <br>
    <br>
@if (Auth::user()->id == 87)
<a href="../payments/admin/delete/{{ $payment->id }}" class="small-submit-button" role="button">Remove</a>
@endif

    <div class="section-row">
            <div class="section-rebate dropShadow margin displayFlex"> 
                <div class="submissionHeadings displayFlex">
                    <h2>Customer Billing Info</h2>
                    <div class="header-side">
        
                    </div>
                
                </div>
                <div>
                    <div class="flex-row">
                        <div class="flex-row-item">
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>Full Name</strong></p>
                                <p class="p50">{{$payment->submission->customerInfo->fname}} {{$payment->submission->customerInfo->lname}}</p>
                            </div>
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>Phone Number</strong></p>
                                <p class="p50">{{$payment->submission->customerInfo->phone}}</p>
                            </div>
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>Email Address</strong></p>
                                <p class="p50">{{$payment->submission->customerInfo->email}}</p>
                            </div>
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>Company</strong></p>
                                <p class="p50">{{$payment->submission->customerInfo->company}}</p>
                            </div>

                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>Country</strong></p>
                                @if($payment->submission->customerInfo->country === 'us')
                                <p class="p50">United States</p>
                                @elseif($payment->submission->customerInfo->country === 'ca')
                                <p class="p50">Canada</p>
                                @else
                                <p class="p50">N/A</p>
                                @endif
                            </div>

                        </div>
        
                        <div class="flex-row-item">
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>Address</strong></p>
                                <p class="p50">{{$payment->submission->customerInfo->address}}</p>
                            </div>
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>City</strong></p>
                                <p class="p50">{{$payment->submission->customerInfo->city}}</p>
                            </div>
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>Postal</strong></p>
                                <p class="p50">{{$payment->submission->customerInfo->postal}}</p>
                            </div>
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>Profession</strong></p>
                                <p class="p50">{{$payment->submission->customerInfo->profession}}</p>
                            </div>
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>Channel Partner Name (Optional)</strong></p>
                                <p class="p50">{{$payment->submission->customerInfo->channel}}</p>
                            </div>
                        </div>
        </div>
                    
                </div>
            </div>
                </div>
<div class="section-row">
        <div class="section-rebate dropShadow payment-info-container margin"> 
            <div class="submissionHeadings displayFlex">
                <h2>Override Purchase Details</h2>

            </div>


    <form class='dropShadow standard-form' name='payment-form' method="POST" action="{{ url('update-payments') }}/{{ $payment->id }}">
        @csrf
        <div class=" payment-item-container">
        <div class='flex-row-item'>
            <label for="status">Purchase Status:</label>
            <select name="status" id="status">
                @foreach ($statuses as $status)
                    <option @if ($status->status == $payment->submission->payment_state->status) {{ 'selected' }} @endif value="{{$status->id}}">{{$status->status}}</option>
                @endforeach
            </select>
        </div>
        <div class='flex-row-item'>
            <label for="purchasevalue">Purchase Value:</label>
            <input required type="number" step="any" placeholder="Purchase Value" value='{{ $payment->payment_amount_cad }}' name='purchasevalue'>          
        </div>

        <div class='flex-row-item'>
            <label for="purchasevalue">Remaining Value:</label>
            <input required type="number" step="any" placeholder="Purchase Value" value='{{ $payment->remainingvalue }}' name='remainingvalue'>          
        </div>

    </div>

            <p class='legal-text'>This will override the purchase details. This can allow you to increase/decrease the purchase value or change the status if needed.</p>
    </div>


<br>
    <input class='payment-submission small-submit-button' type="submit" value="Update Payment">

</form>
</div>

</section>
@endsection