@extends('layout.public')

@section('content')
    <div class="flex gap-4 flex-col items-center justify-center">
        <h1 class="text-3xl font-bold">Sign In</h1>
        <form class="flex flex-col gap-3 text-lg" method="POST" action="{{ route('auth.signin.post') }}">
            {{ csrf_field() }}
            <div>
                <div class="flex justify-end gap-2">
                    <label for="username">Username :</label>
                    <input class="border-2 w-60" type="text" name="username">
                </div>
                @error('username')
                    <span class="text-md text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <div class="flex justify-end gap-2">
                    <label for="password">Password :</label>
                    <input class="border-2 w-60" type="text" name="password">
                </div>
                @error('password')
                    <span class="text-md text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-center">
                <input class="border-2" type="submit" value="Sign In">
            </div>
        </form>
    </div>
@endsection
