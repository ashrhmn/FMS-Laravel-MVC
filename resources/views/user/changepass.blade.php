@extends('layout.userLayout')

@section('content')

<h1>Change Password</h1>

<form action="{{route('user.changepassSubmit')}}" method="POST">
    {{@csrf_field()}}
    <table>
        <tr>
            <input type="hidden" name="uname" value="{{$user->username}}">
            <th>Old Password: </th>
            <td>
            <input type="password" name="oldpass"  />
                @error('oldpass')
                <span>{{$message}}</span>
                @enderror</br>
            </td>
        </tr>
        <tr>
            <th>Password: </th>
            <td>
            <input type="password" name="password" />
            @error('password')
            <span>{{$message}}</span>
            @enderror
            </td>
        </tr>
        <tr>
            <th>Confirm Pass: </th>
            <td>
            <input type="password" name="conpass" />
            @error('conpass')
            <span>{{$message}}</span>
            @enderror</br>
            </td>
        </tr>
        
        <tr>
            <td><button type="submit" class="bg-blue-300 text-5xl text-center hover:bg-green-400">Change Password</button><td>
        </tr>
    </table>

</form>

@endsection