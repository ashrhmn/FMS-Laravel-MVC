@extends('layout.userLayout')
@section('content')

<form action="{{route('user.editProfileSubmit')}}" method="post">
    {{@csrf_field()}}

    <h1>Update Profile</h1>

<input type="hidden" name="password" value="{{$user->password}}"/>
<input type="hidden" name="id" value="{{$user->id}}"/>
<input type="hidden" name="role" value="{{$user->role}}"/>

<b>Name:</b><input type="text" name="name" value="{{$user->name}}" placeholder=""/></br>
@error('name')
<span>{{$message}}</span>
@enderror</br>

<b>Email:</b><input type="email" name="email" value="{{$user->email}}"placeholder=""/></br>
@error('email')
<span>{{$message}}</span>
@enderror

<b>Phone No:</b><input type="phone" name="phone" value="{{$user->phone}}" placeholder=""/></br>
@error('phone')
<span>{{$message}}</span>
@enderror</br>

<b>Date Of Birth:</b>   <input type="date" name="dob" value="{{$user->date_of_birth}}" placeholder=""/></br>
@error('dob')
<span>{{$message}}</span>
@enderror</br>

</span><b>Address:</b></label>
<input type="text" id="address" name="address" value="{{$user->address}}"/><br>
@error('address')
<span>{{$message}}</span>
@enderror</br>

<button type="submit" class="bg-blue-300 text-5xl text-center hover:bg-green-400">Update</button>

</form>

@endsection