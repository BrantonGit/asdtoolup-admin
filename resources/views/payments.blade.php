@extends('layouts.app')
@section('title', 'All Certificates')
@section('content')
<div class="container dashboard">
    <div class="content">
    <h1>ASD Tool Up Program</h1>
    <br>
    <h2>All Purchases</h2>
    <br>


    <div class="search-filters">
        <form action="payments" method='get'>
        <select name="sort_status">
            <option value="0">All Purchases</option>
            @foreach($statuses as $status)
            <option @if($selected_status == $status->id) selected @endif value="{{$status->id}}">{{$status->status}}</option>
            @endforeach
        </select>
        <select name="sort_date">
            <option @if($selected_date1 == 'newest') selected @endif value="newest">Newest</option>
            <option @if($selected_date1 == 'oldest') selected @endif value="oldest">Oldest</option>
        </select>
        <select name="sort_count">
            <option @if($selected_count == 10) selected @endif value="10">Show 10</option>
            <option @if($selected_count == 20) selected @endif value="20">Show 20</option>
            <option @if($selected_count == 40) selected @endif value="40">Show 40</option>
        </select>
        <input type="submit" value='+ Apply Filters'>
        </form>
    </div>

    @if(count($payments)!==0)

    <a href="{{ url('/export-purchases-report') }}">Export Purchases</a>
    <div class="section-rebate table-list">
    <div class="table-headers">
    <ul class='seven-col'>
        <li><h4>Customer</h4></li>
        <li><h4>Company</h4></li>
        <li><h4>Submission</h4></li>
        <li><h4>Published</h4></li>
        <li><h4>Status</h4></li>
        <li><h4>Value</h4></li>
        <li></li>
    </ul>  
    </div>
    @foreach($payments as $payment)
    <div class="table-row">
        <div class="table-row-head single-row">
            <h3>Payment #{{$payment->submission->id}}</h3>
        </div>
        <ul class='seven-col'>
            <li>
                <div class='single-row item-title'>
                    <h5>Customer:</h5>
                </div>
                <div class="item-content">
                    
                    <p>{{$payment->submission->customerInfo->fname}} {{$payment->submission->customerInfo->lname}}</p>
                </div>
            </li>
            <li>
                <div class='single-row item-title'>
                    <h5>Company:</h5>
                </div>
                <div class="item-content">
                    <p>{{$payment->submission->customerInfo->company}}</p>
                </div>
            </li>
            <li>
                <div class='single-row item-title'>
                    <h5>Submission:</h5>
                </div>
                <div class="item-content">
                    <p>{{$payment->submission->id}}</p>
                </div>
            </li>
            <li>
                <div class='single-row item-title'>
                    <h5>Published:</h5>
                </div>
                <div class="item-content">
                    <p>{{$payment->created_at->format('Y-m-d')}}</p>
                </div>
            </li>
            <li>
                <div class='single-row item-title'>
                    <h5>Status:</h5>
                </div>
                <div class="item-content">
                <p
                @if($payment->submission->payment_state->id == 1)
                class='statusText-3'
                @else
                class='statusText-4'
                @endif
                >{{$payment->submission->payment_state->status}}
            </p>
                </div>
            </li>
            <li>
                <div class='single-row item-title'>
                    <h5>Purchase Value</h5>
                </div>
                <div class="item-content">
                    <p>Purchase Value: ${{$payment->payment_amount_cad}} CAD</p>
                    <p>Remaining Value: ${{$payment->remainingvalue}} CAD</p>
                </div>
            </li>
            <li class='details-link'>
                <p><a href="{{url('/payments/'.$payment->id)}}">View Details</a></p>
            </li>
            
        </ul>
        </div>
        @endforeach

    </div>
    <div class="pagination-links">
    {{ $payments->links() }}
    </div>
@else
<br>
<p>There are no purchases found.</p>
@endif
</div>
</div>
@endsection
