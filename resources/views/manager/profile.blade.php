@extends('layout.managerApp')

@section('content')

<h2>Manager profile</h2>

<h5>Name:  {{$user->name}}  </h5>
<h5>Username: {{$user->username}} </h5>
<h5>Email: {{$user->email}} </h5>
<h5>Phone:  {{$user->phone}}  </h5>
<h5>Date of Birth: {{$user->date_of_birth}} </h5>
<h5>Address: {{$user->address}} </h5>


<a href="{{route('manager.editProfile',['id'=>encrypt($user->id)])}}" class="btn btn-success">Edit Profile</a>
<a href="" class="btn btn-success">Change Password</a>


@endsection