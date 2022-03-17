@extends('layout.userLayout')
@section('content')

<form action="{{route('user.editProfileSubmit')}}" method="post">
    {{@csrf_field()}}

    <h1>Update Profile</h1>
    <div class="form-group">
<input type="hidden" name="password" value="{{$user->password}}"/>
<input type="hidden" name="id" value="{{$user->id}}"/>
<input type="hidden" name="role" value="{{$user->role}}"/>

<b>Name:</b><input type="text" name="name" value="{{$user->name}}" placeholder="" class="form-control"/></br>
@error('name')
<span>{{$message}}</span>
@enderror</br>

<b>Email:</b><input type="email" name="email" value="{{$user->email}}"placeholder="" class="form-control"/></br>
@error('email')
<span>{{$message}}</span>
@enderror

<b>Phone No:</b><input type="phone" name="phone" value="{{$user->phone}}" placeholder="" class="form-control"/></br>
@error('phone')
<span>{{$message}}</span>
@enderror</br>

<b>Date Of Birth:</b>   <input type="date" name="dob" value="{{$user->date_of_birth}}" placeholder="" class="form-control"/></br>
@error('dob')
<span>{{$message}}</span>
@enderror</br>

</span><b>Address:</b></label>
<input type="text" id="address" name="address" value="{{$user->address}}" class="form-control"/><br>
@error('address')
<span>{{$message}}</span>
@enderror</br>
    </div>
<button type="submit" class="btn btn-primary">Update</button>

</form>

@endsection