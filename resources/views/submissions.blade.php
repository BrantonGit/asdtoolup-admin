@extends('layouts.app')
@section('title', 'All Submissions')
@section('content')
<div class="container dashboard">
    <div class="content">
    <h1>ASD Tool Up Program</h1>
    <br>
    <h2>All Submissions</h2>
    <br>


    <div class="search-filters">
        <form action="submissions" method='get'>
        <select name="sort_status">
            <option @if($selected_status == '0') selected @endif value="0">All Submissions</option>
            @foreach($statuses as $status)
                <option @if($selected_status == $status->id) selected @endif value="{{$status->id}}">{{$status->status}}</option>
            @endforeach
        </select>
        <select name="sort_date">
            <option @if($selected_date == 'newest') selected @endif value="newest">Newest</option>
            <option @if($selected_date == 'oldest') selected @endif value="oldest">Oldest</option>
            <option @if($selected_date == 'lastupdated') selected @endif value="lastupdated">Last Updated</option>
        </select>
        <select name="sort_count">
            <option @if($selected_count == 10) selected @endif value="10">Show 10</option>
            <option @if($selected_count == 20) selected @endif value="20">Show 20</option>
            <option @if($selected_count == 40) selected @endif value="40">Show 40</option>
        </select>
        <input type="submit" value='+ Apply Filters'>
        </form>
    </div>
    @if(count($submissions) !== 0)

<div class="section-rebate table-list">
    <div class="table-headers">
    <ul class='seven-col'>
        <li><h4>Customer</h4></li>
        <li><h4>Company</h4></li>
        <li><h4>Submission</h4></li>
        <li><h4>Published</h4></li>
        <li><h4>Status</h4></li>
        <li><h4>Country</h4></li>
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
                    {{-- {{$submission}} --}}
      
                    <p>@isset($submission->customerInfo->fname)
{{$submission->customerInfo->fname}} {{$submission->customerInfo->lname}}

@endisset</p>
                </div>
            </li>
            <li>
                <div class='single-row item-title'>
                    <h5>Company:</h5>
                </div>
                <div class="item-content">
                    @isset($submission->customerInfo->company)
                    <p>{{$submission->customerInfo->company}}</p>
                    @endisset
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
                    <h5>Country:</h5>
                </div>
                <div class="item-content">
                    @if($submission->customerInfo->country === 'us')
                    <p>United States</p>
                    @elseif($submission->customerInfo->country === 'ca')
                    <p>Canada</p>
                    @else
                    <p>N/A</p>
                    @endif
                </div>
            
            </li>
            <li class='details-link'>
                <p><a href="{{url('/submissions/'.$submission->id)}}">View Details</a></p>
                @if (Auth::user()->id == 87)
                <br><br>
                <p><a href="{{url('/submissions/admin/delete/'.$submission->id)}}">Remove</a></p>
                @endif
            </li>
            
        </ul>
        </div>
        @endforeach
    </div>
    <div class="pagination-links">
    {{ $submissions->links() }}
    </div>
</div>
@else
<p class='none-found'>No submissions found.</p>
@endif
</div>

</div>
@endsection
