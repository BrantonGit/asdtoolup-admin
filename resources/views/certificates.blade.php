@extends('layouts.app')
@section('title', 'All Certificates')
@section('content')
<div class="container dashboard">
    <div class="content">
    <h1>ASD Tool Up Program</h1>
    <br>
    <h2>All Product Redemptions</h2>
    <br>




    @if(count($certificates) !== 0)
<a href="{{ url('/export-certificates-report') }}">Export Report</a>
<div class="section-rebate table-list">
    <div class="table-headers">
    <ul class='seven-col'>
        <li><h4>Customer</h4></li>
        <li><h4>Redemption ID</h4></li>
        <li><h4>Issue Date</h4></li>
        <li><h4>Product Redeemed</h4></li>
        <li><h4>Tier Level</h4> </li>
        <li><h4>Status</h4> <small>* Managed by 3M</small></li>
        <li></li>
    </ul>  
    </div>
    @foreach($certificates as $certificate)
    <div class="table-row">
        <div class="table-row-head single-row">
            <h3>{{$certificate->certid}}</h3>
        </div>
        <ul class='seven-col'>
            <li>
  
                @isset($certificate->author->fname )
                <div class="item-content">
                    <p>{{$certificate->author->fname}} {{$certificate->author->lname}}</p>
                    </div>
                    @endisset
            </li>
            <li>
                <div class="item-content">
                    <p>{{$certificate->certid}}</p>
                    </div>
            </li>
            <li>
                <div class="item-content">
                    <p>{{$certificate->issuedate}}</p>
                    </div>
            </li>
            <li>
                <div class="item-content">
                    <p>{{ optional($certificate->reward)->name }} (Model: {{ optional($certificate->option)->model }})</p>
                    <p></p>
                    </div>
            </li>
            <li>
    
                <div class="item-content">
                <p>${{$certificate->value}}</p>
                {{-- <p>{{$certificate->months}} months</p> --}}
                </div>
            </li>

            <li>
    
                <div class="item-content">
                <p>@if($certificate->redeemed == 0) Enabled @else Disabled @endif</p>
                    <br>
                <p>@if($certificate->shipped == 0) Not Shipped @else Shipped @endif</p>
                <p>Tracking Number: {{$certificate->tracking}}</p>
                </div>
            </li>
            <li class='details-link'>
                <p><a href="{{url('/certificates/shipping/'.$certificate->certid)}}">Shipping</a></p>
       
                <br><br>
        
          
                <p><a href="{{url('/certificates/disable/'.$certificate->certid)}}"> @if($certificate->redeemed == 0) Disable @else Enable @endif</a></p>
                
               
            </li>
            
        </ul>
        </div>
        @endforeach
    </div>
    <div class="pagination-links">
    {{ $certificates->links() }}
    </div>
</div>
@else
<p class='none-found'>There are no product redemptions found.</p>
@endif

</div>

</div>
@endsection
