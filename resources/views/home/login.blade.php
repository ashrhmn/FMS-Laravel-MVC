
@extends('layout.app')

@section('content')


<form action="{{route('login.submit')}} "method="post"  >
   
{{@csrf_field()}}


    <b>username:<b><input type="username" class="" name="username" value="{{old('username')}}"placeholder="" id="">
    @error('username')
    <span>{{$message}}</span>
    @enderror
    <br>
    <b>Email:<b><input type="email" class="" name="email" value="{{old('email')}}"placeholder="" id="">
    @error('email')
    <span>{{$message}}</span>
    @enderror
    <br>

    <b>Password:<b><input type="password" class="" name="password" placeholder="" id="">

    @error('password')
    <span>{{$message}}</span>
    @enderror
    <br>


  <button type="submit" class="btn btn-primary">login</button>
</form>


@endsection



