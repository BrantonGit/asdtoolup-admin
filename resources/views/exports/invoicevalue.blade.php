@extends('layouts.app')

@section('title', 'Total invoice value by user')
@section('content')
<section class="container">
<div class="content">
<table>
    <thead>
    <tr>
    <th>Internal ID</th>
    <th>Customers Name</th>
        <th>Email Address</th>
        
        <th>Number of Submissions</th>
        <th>Total Approved Invoice Value</th>


    </tr>
    </thead>
    <tbody>
        @foreach($customers as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->fname }} {{ $user->lname }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ count($user->subs) }}</td>
            <td>$ {{ $user->total }}</td>
        </tr>



        @endforeach
    </tbody>
</table>
</div>
</section>
@endsection
