@extends('layout.flightManager')

@section('content')
    <h1 class="text-3xl font-bold text-center my-8">Dashboard</h1>
    <form class="flex justify-center my-10 gap-4 items-center" action="" method="POST">
        <div class="flex justify-end items-center gap-2">
            <label for="name">Name : </label>
            <input class="border-2 w-60" type="text" name="name">
            <input class="bg-blue-600 text-white rounded px-2 py-1" type="submit" value="Add New">
        </div>
    </form>
    <table class="mx-auto">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Schedule</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transports as $transport)
                <tr class="border-t-2 border-b-2">
                    <td class="px-8">{{ $transport->id }}</td>
                    <td class="px-8">{{ $transport->name }}</td>
                    <td class="px-8">
                        @foreach ($transport->transportSchedules as $schedule)
                            From <b>{{ $schedule->fromstopage->name }}, {{ $schedule->fromstopage->city->name }},
                                {{ $schedule->fromstopage->city->country }}</b> To <b>{{ $schedule->tostopage->name }},
                                {{ $schedule->tostopage->city->name }},
                                {{ $schedule->tostopage->city->country }}</b>
                            <br />
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
