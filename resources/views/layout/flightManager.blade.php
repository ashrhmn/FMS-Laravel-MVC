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
    <nav>
        <ul>
            <li> <a href="{{ route('fmgr.dashboard') }}">Dashboard</a> </li>
        </ul>
    </nav>
    @yield('content')
</body>

</html>
