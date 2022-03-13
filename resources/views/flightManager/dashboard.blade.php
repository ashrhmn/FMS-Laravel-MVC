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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transports as $transport)
                <tr class="border-t-2 border-b-2">
                    <td class="px-8">{{ $transport->id }}</td>
                    <td class="px-8">{{ $transport->name }}</td>
                    <td class="px-8 min-w-[20rem]">
                        @foreach ($transport->transportSchedules as $schedule)
                            FROM <b>{{ $schedule->fromstopage->name }}, {{ $schedule->fromstopage->city->name }},
                                {{ $schedule->fromstopage->city->country }}</b> <br> TO
                            <b>{{ $schedule->tostopage->name }},
                                {{ $schedule->tostopage->city->name }},
                                {{ $schedule->tostopage->city->country }}</b>
                            <br>
                            {{ substr(str_pad($schedule->time, 4, '0', STR_PAD_LEFT), 0, 2) }}
                            :
                            {{ substr(str_pad($schedule->time, 4, '0', STR_PAD_LEFT), 2, 2) }}
                            -
                            {{ $schedule->day }}
                            <br>
                            <a class="bg-red-500 text-white p-1 rounded"
                                href="{{ route('fmgr.delete.schedule', ['id' => $schedule->id]) }}">Delete</a>
                            <br />
                            <br />
                        @endforeach
                    </td>
                    <td class="px-8">
                        <a class="bg-green-600 text-white p-1 rounded"
                            href="{{ route('fmgr.add.schedule', ['tid' => $transport->id]) }}">Add Schedule</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
