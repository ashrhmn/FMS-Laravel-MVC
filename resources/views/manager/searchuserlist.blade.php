@extends('layout.managerApp')

@section('content')


<form action="{{route('manager.searchuserlistsubmit')}}" method="post">
    {{@csrf_field()}}
    <table>
        <tr>
            <th>By Email</th>
            <th>By Username</th>
        </tr>
        <tr>
            
            <td><input type="text" name="email" value="{{old('email')}}"/></td>
            <td><input type="text" name="uname" value="{{old('uname')}}"/></td>
            <td><input type="submit" value="Search User" /></td>
        </tr>
    </table>
</form>

@if(count($users)>0)
    <table class="table table-formed">
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
        </tr>
        @foreach($users as $u)
            <tr>
                <td>{{$u->name}}</td>
                <td><a href="{{route('manager.userdetails',['id'=>encrypt($u->id)])}}" class="btn-success"> {{$u->username}}</td>
                <td>{{$u->email}}</td>
            </tr>
        @endforeach
    </table>
@else
    <h4>No User found</h4>
@endif




@endsection