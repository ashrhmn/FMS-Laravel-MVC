@extends('layout.userLayout')
@section('content')
@if(Session::has('msg'))
    <p class="alert alert-info">{{ Session::get('msg') }}</p>
@endif
    <h1>Profile Info</h1>
    <h3>Name: {{$user->name}}</h3>
    <h3>User Name: {{$user->username}}</h3>
    <h3>Date of Birth: {{$user->date_of_birth}}</h3>
    <h3>Address: {{$user->address}}</h3>
    <h3>Email: {{$user->email}}</h3>
    <h3>Phone: {{$user->phone}}</h3>

    <a href="{{route('user.editProfile',['id'=>encrypt($user->id)])}}" class="btn btn-warning">Edit Profile</a>
    <a href="{{route('user.changepass',['id'=>encrypt($user->id)])}}" class="btn btn-warning">Change Password</a>
    
@endsection