@extends('layouts.app')
@section('title', 'All Users')
@section('content')
<div class="container dashboard">
    <div class="content">
    <h1>ASD Tool Up Program</h1>
    <br>
    <h2>All Customers</h2>
    <br>
    <div class="search-filters">
        <form action="customers" method='get'>
        <select name="sort_status">
            <option value="0">Sort By</option>
            <option @if($selected_status == 'name') selected @endif value="fname">Name</option>
            <option @if($selected_status == 'company') selected @endif value="company">Company</option>
            <option @if($selected_status == 'profession') selected @endif value="profession">Profession</option>
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
    <div class="section-rebate table-list">
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
    </div>

    <div class="pagination-links">
        {{ $users->links() }}
        </div>
</div>
</div>
@endsection
