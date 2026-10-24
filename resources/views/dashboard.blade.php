@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<div class="container dashboard">
<div class="admin-bg">
    <h1>ASD <br>Tool Up</h1>
    <br>
    <h2>Admin Dashboard</h2>
    <br>
</div>

<div class="content">

<div class="displayFlexNormal">
    {{-- <div class='dropShadow analytic-section'>
        <h2>Rebate Analytics</h2>
        <hr>
        <div class="analytics-graphs">
        <div class="analytic-item">
            <h3>Accepted Submissions</h3>
            <p>{{$acceptanceRate[0]}} / {{$acceptanceRate[1]}} Total Submissions</p>
            <div class="bar-graph">

    <div class="c100 p{{$acceptanceRate[2]}} big">
        <span>{{$acceptanceRate[2]}}%</span>
        <div class="slice">
            <div class="bar"></div>
            <div class="fill"></div>
        </div>
    </div>
</div>
        </div>

        <div class="analytic-item">
            <h3>Total Amount Paid</h3>
            <p>${{$paidRebateVal}} / ${{$paymentsOwed}} CAD</p>
            <div class="bar-graph">

<div class="c100 p{{$paymentPercent}} big">
    <span>{{$paymentPercent}}%</span>
    <div class="slice">
        <div class="bar"></div>
        <div class="fill"></div>
    </div>
</div>
</div>
        </div>
        </div>
    </div> --}}

    <div class='dropShadow analytic-section'>
    <h2>Usage Statistics</h2>
    {{-- <hr> --}}
        <div class="analytic-row">
            <div class="analytic-info">
                <strong>{{$submissionCount}}</strong><p>Total Submissions</p>
            </div>
            <div class="analytic-icon">
                <img src="{{ asset('images/icons/icon_invoices.svg') }}" alt="Total Accounts Created Icon">
            </div>
        </div>
        <div class="analytic-row">
            <div class="analytic-info">
            <strong>{{$paymentCount}}</strong><p>Total Purchases</p>
            </div>
            <div class="analytic-icon">
                <img src="{{ asset('images/icons/icon_payments-01.svg') }}" alt="Submissions Created Today">
            </div>
        </div>
        <div class="analytic-row">
            <div class="analytic-info">
            <strong>{{$userCount}}</strong><p>Total Customers</p>
            </div>
            <div class="analytic-icon">
                <img src="{{ asset('images/icons/customers.svg') }}" alt="Days remaining for rebate">
            </div>
        </div>

        <div class="analytic-row">
            <div class="analytic-info">
            <strong>{{$certificates}}</strong><p>Total Redemptions</p>
            </div>
            <div class="analytic-icon">
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477 477" style="enable-background:new 0 0 477 477;" xml:space="preserve"> <path d="M462,55H15C6.716,55,0,61.715,0,70v298c0,8.284,6.716,15,15,15h263.7v29c0,3.449,1.777,6.654,4.702,8.481 c1.614,1.009,3.453,1.519,5.298,1.519c1.497,0,2.998-0.336,4.387-1.014l28.393-13.858l28.394,13.858 c3.103,1.515,6.763,1.322,9.685-0.505c2.925-1.827,4.702-5.032,4.702-8.481v-29H462c8.284,0,15-6.716,15-15V70 C477,61.715,470.284,55,462,55z M278.172,270.692c0-23.879,19.428-43.307,43.307-43.307c23.88,0,43.308,19.428,43.308,43.307 c0,23.88-19.428,43.308-43.308,43.308C297.6,314,278.172,294.572,278.172,270.692z M364.26,317.308 c12.608-11.58,20.526-28.188,20.526-46.616c0-34.907-28.399-63.307-63.308-63.307c-34.907,0-63.307,28.399-63.307,63.307 c0,18.429,7.92,35.038,20.528,46.618V324H102.072C97.978,302.228,80.771,285.022,59,280.927V157.072 c21.771-4.095,38.978-21.301,43.072-43.072h272.855c4.095,21.771,21.301,38.978,43.072,43.072v123.855 c-21.771,4.095-38.978,21.301-43.072,43.072H364.26V317.308z M344.26,395.991l-18.394-8.978c-2.77-1.352-6.004-1.352-8.773,0 l-18.393,8.978v-66.247c7.074,2.738,14.75,4.256,22.778,4.256c8.03,0,15.707-1.519,22.781-4.257V395.991z M447,353h-82.74v-9H384 c5.522,0,10-4.478,10-10c0-18.748,15.252-34,34-34c5.522,0,10-4.478,10-10V148c0-5.522-4.478-10-10-10c-18.748,0-34-15.252-34-34 c0-5.522-4.478-10-10-10H93c-5.522,0-10,4.478-10,10c0,18.748-15.252,34-34,34c-5.522,0-10,4.478-10,10v142c0,5.522,4.478,10,10,10 c18.748,0,34,15.252,34,34c0,5.522,4.478,10,10,10h185.7v9H30V85h417V353z"/> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
            </div>
        </div>
        {{-- <div class="analytic-row">
            <div class="analytic-info">
            <strong>March 1, 2021</strong><p></p>
            </div>
            <div class="analytic-icon">
                <img src="{{ asset('images/icons/icon_calendar.svg') }}" alt="Days remaining for rebate">
            </div>
        </div> --}}


        


        
    </div>

    

    
</div>



<div class='dropShadow analytic-section'>
    <h2>Reports</h2>
    {{-- <hr> --}}

        <div class="analytic-row">
            <div class="analytic-info">
                <a href="{{url('/reports/invoice-value-by-user')}}"> <strong>Total invoice value by user</strong></a>
            </div>
        </div>

        {{-- <div class="analytic-row">
            <div class="analytic-info">
            <strong>March 1, 2021</strong><p></p>
            </div>
            <div class="analytic-icon">
                <img src="{{ asset('images/icons/icon_calendar.svg') }}" alt="Days remaining for rebate">
            </div>
        </div> --}}

        
    </div>


{{-- <div class="section-rebate table-list dropShadow">
    <div class="home-title">
        <h2>Recent Submissions</h2>
        <p><a href="{{url('/submissions')}}">View All Submissions</a></p>
    </div>
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
                    <p>${{$submission->totalAmount}} CAD</p>
                </div>
            </li>
            <li class='details-link'>
                <p><a href="{{url('/submissions/'.$submission->id)}}">View Details</a></p>
            </li>
            
        </ul>
        </div>
        @endforeach
    </div> --}}


    {{-- <div class="section-rebate table-list dropShadow">
    <div class="home-title">
        <h2>Recent Payments</h2>
        <p><a href="{{url('/payments')}}">View All Payments</a></p>
    </div>
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
    @foreach($payments as $payment)
    <div class="table-row">
        <div class="table-row-head single-row">
            <h3>Submission #{{$payment->submission->id}}</h3>
        </div>
        <ul class='seven-col'>
            <li>
                <div class='single-row item-title'>
                    <h5>Customer:</h5>
                </div>
                <div class="item-content">
                    <p>{{$payment->submission->author->fname.' '.$payment->submission->author->lname}}</p>
                </div>
            </li>
            <li>
                <div class='single-row item-title'>
                    <h5>Company:</h5>
                </div>
                <div class="item-content">
                    <p>{{$payment->submission->author->company}}</p>
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
                >
                {{$payment->submission->payment_state->status}}</p>
                </div>
            </li>
            <li>
                <div class='single-row item-title'>
                    <h5>Rebate:</h5>
                </div>
                <div class="item-content">
                    <p>${{$payment->submission->totalAmount}} CAD</p>
                </div>
            </li>
            <li class='details-link'>
                <p><a href="{{url('/payments/'.$payment->id)}}">View Details</a></p>
            </li>
            
        </ul>
        </div>
        @endforeach
    </div> --}}


        {{-- <div class="section-rebate table-list dropShadow">
        <div class="home-title">
            <h2>Newest Customers</h2>
            <p><a href="{{url('/users')}}">View All Customers</a></p>
        </div>
        <div class="table-headers">
        <ul class='six-col'>
            <li><h4>Customer</h4></li>
            <li><h4>Email</h4></li>
            <li><h4>Company</h4></li>
            <li><h4>Profession</h4></li>
            <li><h4>Signed Up</h4></li>
            <li><h4>Profiles</h4></li>
        </ul>  
        </div>
        @foreach($users as $user)
    <div class="table-row">
        <div class="table-row-head single-row">
            <h3>{{$user->fname}} {{$user->lname}}</h3>
        </div>
        <ul class='six-col'>
            <li>
                <div class='single-row item-title'>
                    <h5>Customer:</h5>
                </div>
                <div class="item-content">
                    <p>{{$user->fname}} {{$user->lname}}</p>
                </div>
            </li>
            <li>
                <div class='single-row item-title'>
                    <h5>Email:</h5>
                </div>
                <div class="item-content">
                    <p>{{$user->email}}</p>
                </div>
            </li>
            <li>
                <div class='single-row item-title'>
                    <h5>Company:</h5>
                </div>
                <div class="item-content">
                    <p>{{$user->company}}</p>
                </div>
            </li>
            <li>
                <div class='single-row item-title'>
                    <h5>Profession:</h5>
                </div>
                <div class="item-content">
                    <p>{{$user->profession}}</p>
                </div>
            </li>
            <li>
                <div class='single-row item-title'>
                    <h5>Signed Up:</h5>
                </div>
                <div class="item-content">
                    <p>{{$user->created_at->format('Y-m-d')}}</p>
                </div>
            </li>

            <li class='details-link'>
                <p><a href="{{ url('/customers/'.$user->id) }}">View Profile</a></p>
            </li>
            
        </ul>
        </div>
        @endforeach
    </div> --}}
    <br>
    <small><strong>V1.0.25 - Modified</strong> (Saas Enhancements: Self-Serve, Tier-based Product Redemption)</small>
    <br><small>Developed by Branton – Please contact us for technical support.</small>
</div>

</div>
@endsection
