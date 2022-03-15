@extends('layout.managerApp')

@section('content')


<form action="" method="">
    {{@csrf_field()}}
    <table>
        <tr>
            <th>Customer Name: </th><td><input type="text" name="name" value="{{Session()->get('uid')}}"/></td>
        </tr>
    </table>
</form>


@endsection