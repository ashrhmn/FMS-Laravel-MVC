@extends('layout.managerApp')

@section('content')

<h1>Manager Home</h1>
<form action="{{route('manager.changepassSubmit')}}" method="post">
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
            <th>Email: </th>
            <td>
            <input type="password" name="password" />
            @error('password')
            <span>{{$message}}</span>
            @enderror
            </td>
        </tr>
        <tr>
            <th>Phone: </th>
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