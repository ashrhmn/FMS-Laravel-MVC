@extends('layout.userLayout')
@section('content')
    <h1>Profile Info</h1>
    <h3>Name: {{$user->name}}</h3>
    <h3>User Name: {{$user->username}}</h3>
    <h3>Date of Birth: {{$user->date_of_birth}}</h3>
    <h3>Address: {{$user->address}}</h3>
    <h3>Email: {{$user->email}}</h3>
    <h3>Phone: {{$user->phone}}</h3>

    <a href="{{route('user.editProfile')}}">Edit Profile</a>
    
@endsection