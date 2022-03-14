@extends('layout.managerApp')

@section('content')


<h1>Flight Manager List</h1>

<form action="{{route('manager.flightManagerSearch')}}" method="post">
    {{@csrf_field()}}
    <table>
        <tr>
            <td>
            <input type="text"  name="uname" placeholder="By Username">
            </td>
            <td><input type="submit" value="Search Flight Manager" /></td>
        </tr>
    </table>
</form>

@if(count($users)>0)
    <table class="table table-formed">
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Create Flight</th>
        </tr>
        @foreach($users as $u)
            <tr>
                <td>{{$u->name}}</td>
                <td><a href="{{route('manager.userdetails',['id'=>encrypt($u->id)])}}" class="btn-success"> {{$u->username}}</a></td>
                @if(count($u->transports) > 0)
                    <td><a href="{{route('manager.creatorFlightList',['id'=>encrypt($u->id)])}}" class="btn-success">Yes </a></td>
                @else
                    <td>Not Found</td>
                @endif
            </tr>
        @endforeach
    </table>
@else
    <h4>No User found</h4>
@endif






@endsection