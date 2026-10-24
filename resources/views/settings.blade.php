@extends('layouts.app')
@section('title', 'My Settings')
@section('content')
<section class="container settings">
<div class="content">
    <form class='dropShadow standard-form' action="{{url('/update-settings')}}" method="POST">
    <h1>My Settings</h1>
    <br>
    @csrf
        <div class='form-group'>
            <label for="fname">3M ID</label>
            <input required type="text" name="fname" value="{{$info->fname}}">
        </div>
        <div class='form-group'>
            <label for="lname">My Last Name</label>
            <input required type="text" name="lname" value="{{$info->lname}}">
        </div>
         <div class='form-group'>
            <label for="address">My Address</label>
            <input required type="text" name='address' value="{{$info->address}}">
        </div>
        <div class='form-group'>
            <label for="city">My City</label>
            <input required type="text" name="city" value="{{$info->city}}">
        </div>
        <div class='form-group'>
            <label for="postal">Postal Code</label>
            <input required type="text" name='postal' value="{{$info->postal}}">
        </div>
        <div class='form-group'>
            <label for="phone">Phone Number</label>
            <input required type="text" name="phone" value="{{$info->phone}}">
        </div>
        <div class='form-group'>
            <label for="company">Company</label>
            <input required type="text" name="company" value="{{$info->company}}">
        </div>
        <div class='form-group'>
            <label for="profession">Profession</label>
            <input required type="text" name="profession" value="{{$info->profession}}">
        </div>

        <input type="submit" class="small-submit-button" value="Update My Settings">

    </form>
</div>
</section>
@endsection
