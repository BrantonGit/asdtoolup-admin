@extends('layouts.app')

@section('title', $user->fname.' '.$user->lname)
@section('content')
<section class="container">
<div class="content">
    <h1>{{$user->fname}} {{$user->lname}}</h1>
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
                                <p class="p50">{{$user->fname}} {{$user->lname}}</p>
                            </div>
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>Phone Number</strong></p>
                                <p class="p50">{{$user->phone}}</p>
                            </div>
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>Email Address</strong></p>
                                <p class="p50">{{$user->email}}</p>
                            </div>
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>Company</strong></p>
                                <p class="p50">{{$user->company}}</p>
                            </div>
                        </div>
        
                        <div class="flex-row-item">
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>Address</strong></p>
                                <p class="p50">{{$user->address}}</p>
                            </div>
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>City</strong></p>
                                <p class="p50">{{$user->city}}</p>
                            </div>
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>Postal</strong></p>
                                <p class="p50">{{$user->postal}}</p>
                            </div>
                            <div class="displayFlex padding borderGray">
                                <p class="p50"><strong>Profession</strong></p>
                                <p class="p50">{{$user->profession}}</p>
                            </div>
                        </div>
        </div>
                    
                </div>
            </div>
                </div>
    <div>

        <div>
            <h2>Their Submissions:</h2>
            <br>
            @if(count($submissions) !== 0)
            <div class="section-rebate table-list">
    <div class="table-headers">
    <ul class='seven-col'>
        <li><h4>Customer</h4></li>
        <li><h4>Company</h4></li>
        <li><h4>Submission</h4></li>
        <li><h4>Published</h4></li>
        <li><h4>Status</h4></li>
        <li><h4>Rebate</h4></li>
        <li></li>
    </ul>  
    </div>
    @foreach($submissions as $submission)
    <div class="table-row">
        <div class="table-row-head single-row">
            <h3>Submission #{{$submission->id}}</h3>
        </div>
        <ul class='seven-col'>
            <li>
                <div class='single-row item-title'>
                    <h5>Customer:</h5>
                </div>
                <div class="item-content">
                    <p>{{$submission->author->fname.' '.$submission->author->lname}}</p>
                </div>
            </li>
            <li>
                <div class='single-row item-title'>
                    <h5>Company:</h5>
                </div>
                <div class="item-content">
                    <p>{{$submission->author->company}}</p>
                </div>
            </li>
            <li>
                <div class='single-row item-title'>
                    <h5>Submission:</h5>
                </div>
                <div class="item-content">
                    <p>{{$submission->id}}</p>
                </div>
            </li>
            <li>
                <div class='single-row item-title'>
                    <h5>Published:</h5>
                </div>
                <div class="item-content">
                    <p>{{$submission->created_at->format('Y-m-d')}}</p>
                </div>
            </li>
            <li>
                <div class='single-row item-title'>
                    <h5>Status:</h5>
                </div>
                <div class="item-content">
                <p class="submissionBubble status-{{$submission->submission_status->id}}">{{$submission->submission_status->status}}</p>
                </div>
            </li>
            <li>
                <div class='single-row item-title'>
                    <h5>Rebate:</h5>
                </div>
                <div class="item-content">
                    @if($submission->payment_section)
                    <p>${{$submission->payment_section->payment_amount_cad}} CAD</p>
                    @else
                    <p>N/A</p>
                    @endif
                </div>
            </li>
            <li class='details-link'>
                <p><a href="{{url('/submissions/'.$submission->id)}}">View Details</a></p>
            </li>
            
        </ul>
        </div>
        @endforeach
    </div>
            @else
            <p>{{$user->fname}} has not created any submissions.</p>
            @endif
        </div>
    </div>
</div>
</section>
@endsection
