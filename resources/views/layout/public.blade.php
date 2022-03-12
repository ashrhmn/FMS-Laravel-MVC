<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Flight Management System</title>
    <link rel="stylesheet" href="../css/app.css">
</head>

<body>
    <nav>
        <ul class="flex gap-10 text-xl font-bold hover:text-blue-400">
            <li> <a href="{{ route('auth.signin') }}">Sign In</a> </li>
            <li> <a href="{{ route('auth.signup') }}">Sign Up</a> </li>
        </ul>
    </nav>
    @yield('content')
</body>

</html>
