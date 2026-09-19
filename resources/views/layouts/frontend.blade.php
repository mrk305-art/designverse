<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'DesignVerse')
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="min-h-screen bg-white text-gray-900 antialiased">

    {{-- DesignVerse Navbar --}}
    @include('home.components.navbar')


    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>


    {{-- DesignVerse Footer --}}
    @include('home.components.footer')


</body>

</html>

