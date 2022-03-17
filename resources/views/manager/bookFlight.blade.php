@extends('layout.managerApp')

@section('content')


<form action="" method="">
    {{@csrf_field()}}
    <table>
        <tr>
            <th>Customer Name: </th><td><input type="text" name="name" value="{{$user}}"/></td>
        </tr>
    </table>
</form>


@endsection