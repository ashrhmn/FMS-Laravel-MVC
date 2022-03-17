@extends('layout.adminApp')

@section('content')

<h1>password change</h1>

<form action="{{route('password.change')}}" method="post">

{{csrf_field()}}

</span><b>Old password</b></label>
<input type="password" name="password" value=""/><br>
@error('password')
<span>{{$message}}</span>
@enderror</br>


</span><b>New password</b></label>
<input type="password" name="password" value=""/><br>
@error('password')
<span>{{$message}}</span>
@enderror</br>

</span><b>confirm password</b></label>
<input type="password" name="password" value=""/><br>
@error('password')
<span>{{$message}}</span>
@enderror</br>

<button type="submit" class="btn btn-success">update</button>


</form>




@endsection