<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error</title>
</head>

<body>
    <h1>Page not found</h1>
    <h2>{{ session('msg') ?? '' }}</h2>
    <h2>{{ session('role-err')? 'Only ' . session('role-err') . ' can access this page, make sure to be logged in as ' . session('role-err'): '' }}
    </h2>
    <a href="/">Back to home</a>
</body>

</html>
