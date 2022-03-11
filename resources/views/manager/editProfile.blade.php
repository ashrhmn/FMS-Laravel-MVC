@extends('layout.managerApp')

@section('content')

<h1>Edit Profile</h1>

<form action="{{route('manager.editProfileSubmit')}}" method="post">
    {{@csrf_field()}}
    <table>
        <tr>
            <input type="hidden" name="uname" value="{{$user->username}}">
            <th>Name: </th>
            <td>
            <input type="text" name="name" value="{{$user->name}}" />
                @error('name')
                <span>{{$message}}</span>
                @enderror</br>
            </td>
        </tr>
        <tr>
            <th>Email: </th>
            <td>
            <input type="email" name="email" value="{{$user->email}}"/>
            @error('email')
            <span>{{$message}}</span>
            @enderror
            </td>
        </tr>
        <tr>
            <th>Phone: </th>
            <td>
            <input type="phone" name="phone" value="{{$user->phone}}" placeholder=""/>
            @error('phone')
            <span>{{$message}}</span>
            @enderror</br>
            </td>
        </tr>
        <tr>
            <th>Date of Birth: </th>
            <td>
            <input type="date" name="date_of_birth" value="{{$user->date_of_birth}}" />
            @error('dob')
            <span>{{$message}}</span>
            @enderror</br>
            </td>
        </tr>
        <tr>
            <th>Address: </th>
            <td>
            <textarea name="address"  >{{$user->address}}</textarea>
            @error('address')
            <span>{{$message}}</span>
            @enderror</br>
            </td>
        </tr>
        <tr>
            <td><button type="submit" class="bg-blue-300 text-5xl text-center hover:bg-green-400">Update</button><td>
        </tr>
    </table>

</form>

@endsection