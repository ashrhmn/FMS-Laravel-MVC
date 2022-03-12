@extends('layout.public')

@section('content')
    <div class="flex gap-4 flex-col items-center justify-center">
        <h1 class="text-3xl font-bold">Sign In</h1>
        <form class="flex flex-col gap-3" action="">
            <div class="flex justify-end gap-2">
                <label for="username">Username :</label>
                <input class="border-2" type="text" name="username">
            </div>
            <div class="flex justify-end gap-2">
                <label for="password">Password :</label>
                <input class="border-2" type="text" name="password">
            </div>
            <div class="flex justify-center">
                <input class="border-2" type="submit" value="Sign In">
            </div>
        </form>
    </div>
@endsection
