@extends('layouts.app')

@section('content')
<section class="container">
<div class="content">

@foreach ($history->history_stages as $his)

<h1>Submission #{{$submission_id}}</h1>

<hr>

<div>
    <h1>User Info</h1>
    <p>User: {{$his->history_stages_submission->customerinfo_section->name}}</p>
    <p>Status: {{$his->history_stages_submission->customerinfo_section->status_state->status}}</p>
</div>

{{-- <hr>

<div>
    <h1>Traded Up Products</h1>
    <p>Comments: {{$history->history_stages[0]->tradedup_section->comments}}</p>
    <p>Status: {{$history->history_stages[0]->tradedup_section->status_state->status}}</p>
</div>

<hr>

<div>
    <h1>Traded In Products</h1>
    <p>Comments: {{$history->history_stages[0]->tradedin_section->comments}}</p>
    <p>Status: {{$history->history_stages[0]->tradedin_section->status_state->status}}</p>
</div>

<hr>

<div>
    <h1>Receipts</h1>
    <p>Comments: {{$history->history_stages[0]->receipt_section->comments}}</p>
    <p>Status: {{$history->history_stages[0]->receipt_section->status_state->status}}</p>
</div> --}}

<hr>

@endforeach
</div>
</section>

@endsection
