@extends('layout.managerApp')

@section('content')

<h2>Manager profile</h2>

@if(Session::has('msg'))
    <p class="alert alert-info">{{ Session::get('msg') }}</p>
@endif

<table class="table table-formed">
    <tr>
        <th>Name:</th>
        <td>{{$user->name}}</td>
    </tr>
    <tr>
        <th>Username:</th>
        <td>{{$user->username}}</td>
    </tr>
    <tr>
        <th>Email: </th>
        <td>{{$user->email}}</td>
    </tr>
    <tr>
        <th>Phone:</th>
        <td>{{$user->phone}}</td>
    </tr>
    <tr>
        <th>Date of Birth:</th>
        <td>{{$user->date_of_birth}}</td>
    </tr>
    <tr>
        <th>Address:</th>
        <td>{{$user->address}}</td>
    </tr>
</table>



<a href="{{route('manager.editProfile',['id'=>encrypt($user->id)])}}" class="btn btn-success">Edit Profile</a>
<a href="{{route('manager.changepass',['id'=>encrypt($user->id)])}}" class="btn btn-success">Change Password</a>


@endsection