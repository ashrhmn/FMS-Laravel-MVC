@extends('layout.flightManager')

@section('content')
    <h1 class="text-3xl font-bold">Dashboard</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Schedule</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transports as $transport)
                <tr>
                    <td>{{ $transport->id }}</td>
                    <td>{{ $transport->name }}</td>
                    <td>{{ $transport->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
