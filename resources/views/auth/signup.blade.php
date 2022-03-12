@extends('layout.public')

@section('content')
    <div class="flex gap-4 flex-col items-center justify-center">
        <h1 class="text-3xl font-bold">Sign Up</h1>
        <form class="flex flex-col gap-3 text-xl" method="POST" action="{{ route('auth.signup.post') }}">
            {{ csrf_field() }}

            <div>
                <div class="flex justify-end gap-2">
                    <label for="username">Username :</label>
                    <input class="border-2 w-60" type="text" value="{{ old('username') }}" name="username">
                </div>
                @error('username')
                    <span class="text-md text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <div class="flex justify-end gap-2">
                    <label for="name">Name :</label>
                    <input class="border-2 w-60" type="text" name="name">
                </div>
                @error('name')
                    <span class="text-md text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <div class="flex justify-end gap-2">
                    <label for="password">Password :</label>
                    <input class="border-2 w-60" type="password" name="password">
                </div>
                @error('password')
                    <span class="text-md text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <div class="flex justify-end gap-2">
                    <label for="password2">Confirm Password :</label>
                    <input class="border-2 w-60" type="password" name="password2">
                </div>
                @error('password2')
                    <span class="text-md text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-end gap-2">
                <label for="city">City :</label>
                <select class="w-60 border-2" name="city">
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}, {{ $city->country }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end gap-2">
                <label for="dob">Date Of Birth :</label>
                <input class="border-2 w-60" type="date" name="dob">
            </div>
            <div class="flex justify-end gap-2">
                <label for="address">Address :</label>
                <input class="border-2 w-60" type="text" name="address">
            </div>
            <div class="flex justify-end gap-2">
                <label for="email">Email :</label>
                <input class="border-2 w-60" type="text" name="email">
            </div>
            <div class="flex justify-end gap-2">
                <label for="phone">Phone :</label>
                <input class="border-2 w-60" type="text" name="phone">
            </div>
            <div class="flex justify-center">
                <input class="w-40 p-2 bg-blue-500 rounded text-white" type="submit" value="Sign Up">
            </div>
        </form>
    </div>
@endsection
