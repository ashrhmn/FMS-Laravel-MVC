@extends('layout.app')
@section('content')

<form action="{{route('register.submit')}}" method="post">
    {{@csrf_field()}}

    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>

<b>Username:</b><input type="text" name="username" value="{{old('username')}}" placeholder=""/></br>
@error('username')
<span>{{$message}}</span>
@enderror</br>

<b>Name:</b><input type="text" name="name" value="{{old('name')}}" placeholder=""/></br>
@error('name')
<span>{{$message}}</span>
@enderror</br>

<b>Email:</b><input type="email" name="email" value="{{old('email')}}"placeholder=""/></br>
@error('email')
<span>{{$message}}</span>
@enderror

<b>Phone No:</b><input type="phone" name="phone" value="{{old('phone')}}" placeholder=""/></br>
@error('phone')
<span>{{$message}}</span>
@enderror</br>

<b>Date Of Birth:</b>   <input type="date" name="dob" value="{{old('dob')}}" placeholder=""/></br>
@error('dob')
<span>{{$message}}</span>
@enderror</br>

</span><b>Address:</b></label>
<textarea id="address" name="address" value="{{old('address')}}" ></textarea><br>
@error('address')
<span>{{$message}}</span>
@enderror</br>

<b>Password:</b><input type="password" name="password"  placeholder=""/></br>
@error('password')
<span>{{$message}}</span>
@enderror</br>

<b>confirm password:</b><input type="password" name="confirm_password" id="confirm_password" /><br>
@error('confirm_password')
<span>{{$message}}</span>
@enderror</br>

<button type="submit" class="bg-blue-300 text-5xl text-center hover:bg-green-400">Register</button>

</form>

@endsection