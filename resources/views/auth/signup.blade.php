@extends('layout.public')

@section('content')
    <h1>Sign In</h1>
    <form action="">
        <div>
            <label for="username">Username</label>
            <input type="text" name="username">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="text" name="password">
        </div>
        <div>
            <input type="submit" value="Sign In">
        </div>
    </form>
@endsection
