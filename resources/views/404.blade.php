<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error</title>
    <link rel="stylesheet" href="../css/app.css">
</head>

<body>
    <div class="mt-10">
        <a class="bg-blue-600 text-white text-md p-3 rounded ml-10 select-none cursor-pointer" href="/">Back to home</a>
        <h1 class="text-9xl font-bold text-center my-12">Page not found</h1>
        <h2 class="text-xl text-green-700 text-center mb-8">{{ session('msg') ?? '' }}</h2>
        <h2 class="text-xl text-red-600 text-center mb-8">
            {{ session('role-err')? 'Only ' . session('role-err') . ' can access this page, make sure to be logged in as ' . session('role-err'): '' }}
        </h2>
    </div>
</body>

</html>
