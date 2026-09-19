
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        DesignVerse
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="bg-white text-gray-900">

    {{-- Navbar --}}
    @include('home.components.navbar')


    {{-- Hero --}}
    @include('home.components.hero')


    {{-- Featured Designs --}}
    @include('home.components.featured-designs')


    {{-- Categories --}}
    @include('home.components.categories')


    {{-- Designers --}}
    @include('home.components.designers')


    {{-- CTA --}}
    @include('home.components.cta')


    {{-- Footer --}}
    @include('home.components.footer')

</body>

</html>

