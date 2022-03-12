<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Flight Manager</title>
    <link rel="stylesheet" href="../css/app.css">
</head>

<body>
    <nav class="bg-blue-900 text-white py-6">
        <ul class="flex px-6 gap-10 text-xl font-bold">
            <li> <a class="hover:text-blue-300" href="{{ route('fmgr.dashboard') }}">Dashboard</a> </li>
        </ul>
    </nav>
    @yield('content')
</body>

</html>
