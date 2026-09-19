<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>DesignVerse</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>

        body{
            font-family:Inter,sans-serif;
            background:#f8fafc;
        }

    </style>

</head>

<body>

<div class="flex">

@include('designer.partials.sidebar')

<div class="flex-1 ml-72">

@include('designer.partials.navbar')

<div class="p-8">

@yield('content')

</div>

</div>

</div>

</body>

</html>