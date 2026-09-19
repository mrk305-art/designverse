<!DOCTYPE html>

<html lang="en">

<head>


<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>
    @yield('title', 'Client Dashboard') - DesignVerse
</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="bg-gray-50 text-gray-900">

@php
    $unreadNotifications = auth()->user()
        ->notifications()
        ->where('is_read', false)
        ->count();
@endphp

<div class="min-h-screen flex">


{{-- ================= CLIENT SIDEBAR ================= --}}
<aside class="w-64 bg-white border-r border-gray-200 shrink-0 flex flex-col min-h-screen">


    {{-- Logo --}}
    <div class="px-6 py-6 border-b border-gray-200">

        <h1 class="text-2xl font-bold tracking-tight text-gray-900">
            DesignVerse
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Creative Space
        </p>

    </div>


    {{-- Navigation --}}
    <nav class="flex-1 px-4 py-6 space-y-2">


        {{-- Dashboard --}}
        <a
            href="{{ route('client.dashboard') }}"
            class="flex items-center gap-3
                   rounded-xl px-4 py-3
                   text-gray-700
                   hover:bg-gray-100
                   hover:text-gray-900
                   transition"
        >

            <span class="text-lg">
                📊
            </span>

            <span class="font-medium">
                Dashboard
            </span>

        </a>


        {{-- Explore --}}
        <a
            href="{{ route('explore') }}"
            class="flex items-center gap-3
                   rounded-xl px-4 py-3
                   text-gray-700
                   hover:bg-gray-100
                   hover:text-gray-900
                   transition"
        >

            <span class="text-lg">
                🔍
            </span>

            <span class="font-medium">
                Explore
            </span>

        </a>


        {{-- Saved Designs --}}
        <a
            href="{{ route('saved.designs') }}"
            class="flex items-center gap-3
                   rounded-xl px-4 py-3
                   text-gray-700
                   hover:bg-gray-100
                   hover:text-gray-900
                   transition"
        >

            <span class="text-lg">
                🔖
            </span>

            <span class="font-medium">
                Saved Designs
            </span>

        </a>


        {{-- Liked Designs --}}
        <a
            href="{{ route('liked.designs') }}"
            class="flex items-center gap-3
                   rounded-xl px-4 py-3
                   text-gray-700
                   hover:bg-gray-100
                   hover:text-gray-900
                   transition"
        >

            <span class="text-lg">
                ❤️
            </span>

            <span class="font-medium">
                Liked Designs
            </span>

        </a>


        {{-- Collections --}}
        <a
            href="{{ route('collections.index') }}"
            class="flex items-center gap-3
                   rounded-xl px-4 py-3
                   text-gray-700
                   hover:bg-gray-100
                   hover:text-gray-900
                   transition"
        >

            <span class="text-lg">
                📁
            </span>

            <span class="font-medium">
                Collections
            </span>

        </a>


        {{-- Following --}}
        <a
             href="{{ route('client.following', auth()->id()) }}"
            class="flex items-center gap-3
                   rounded-xl px-4 py-3
                   text-gray-700
                   hover:bg-gray-100
                   hover:text-gray-900
                   transition"
        >

            <span class="text-lg">
                👥
            </span>

            <span class="font-medium">
                Following
            </span>

        </a>


        {{-- Divider --}}
        <div class="border-t border-gray-200 my-5"></div>


        {{-- Notifications --}}
       <a
    href="{{ route('notifications.index') }}"
    class="flex items-center gap-3
           rounded-xl px-4 py-3
           text-gray-700
           hover:bg-gray-100
           hover:text-gray-900
           transition"
>

    <span class="text-lg">
        🔔
    </span>

    <span class="font-medium flex-1">
        Notifications
    </span>

    @if ($unreadNotifications > 0)

        <span
            class="min-w-[22px] h-[22px]
                   px-1.5
                   rounded-full
                   bg-red-500
                   text-white
                   text-[11px]
                   font-bold
                   flex items-center
                   justify-center"
        >
            {{ $unreadNotifications > 99 ? '99+' : $unreadNotifications }}
        </span>

    @endif

</a>


        {{-- Profile --}}
        <a
            
    href="{{ route('client.profile.edit') }}"
            class="flex items-center gap-3
                   rounded-xl px-4 py-3
                   text-gray-700
                   hover:bg-gray-100
                   hover:text-gray-900
                   transition"
        >

            <span class="text-lg">
                👤
            </span>

            <span class="font-medium">
                My Profile
            </span>

        </a>

    </nav>


    {{-- ================= CLIENT PROFILE / LOGOUT ================= --}}
    <div class="border-t border-gray-200 p-4">


        {{-- Client --}}
        <div class="flex items-center gap-3 mb-4 px-2">

            <div
                class="w-10 h-10 rounded-full
                       bg-indigo-100
                       flex items-center justify-center
                       text-indigo-600 font-bold"
            >

                {{ strtoupper(substr(auth()->user()->name ?? 'C', 0, 1)) }}

            </div>


            <div class="min-w-0">

                <p class="text-sm font-semibold text-gray-900 truncate">
                    {{ auth()->user()->name ?? 'Client' }}
                </p>

                <p class="text-xs text-gray-500">
                    Client
                </p>

            </div>

        </div>


        {{-- Logout --}}
        <form
            method="POST"
            action="{{ route('logout') }}"
        >

            @csrf

            <button
                type="submit"
                class="w-full flex items-center gap-3
                       rounded-xl px-4 py-3
                       text-gray-600
                       hover:bg-gray-100
                       hover:text-gray-900
                       transition"
            >

                <span class="text-lg">
                    🚪
                </span>

                <span class="font-medium">
                    Logout
                </span>

            </button>

        </form>

    </div>

</aside>



{{-- ================= MAIN AREA ================= --}}
<div class="flex-1 min-w-0">


    {{-- Top Header --}}
    <header
        class="h-16 bg-white
               border-b border-gray-200
               flex items-center justify-between
               px-8"
    >

        <div>

            <p class="text-sm text-gray-500">
                Client Area
            </p>

        </div>


        <div class="flex items-center gap-4">


            {{-- Notification --}}
           <a
    href="{{ route('notifications.index') }}"
    class="relative text-gray-500
           hover:text-gray-900
           transition"
>

    <span class="text-lg">
        🔔
    </span>

    @if ($unreadNotifications > 0)

        <span
            class="absolute -top-2 -right-2
                   min-w-[18px] h-[18px]
                   px-1
                   rounded-full
                   bg-red-500
                   text-white
                   text-[10px]
                   font-bold
                   flex items-center
                   justify-center
                   border-2 border-white"
        >
            {{ $unreadNotifications > 99 ? '99+' : $unreadNotifications }}
        </span>

    @endif

</a>


            {{-- User --}}
            <div class="flex items-center gap-3">

                <div class="text-right">

                    <p class="text-sm font-semibold text-gray-900">
                        {{ auth()->user()->name ?? 'Client' }}
                    </p>

                    <p class="text-xs text-gray-500">
                        Client
                    </p>

                </div>


                <div
                    class="w-9 h-9 rounded-full
                           bg-indigo-100
                           flex items-center justify-center
                           text-indigo-600
                           font-bold"
                >

                    {{ strtoupper(substr(auth()->user()->name ?? 'C', 0, 1)) }}

                </div>

            </div>

        </div>

    </header>


    {{-- Success Message --}}
    @if (session('success'))

        <div class="mx-8 mt-6 rounded-xl
                    bg-green-50
                    border border-green-200
                    px-5 py-4
                    text-sm font-semibold
                    text-green-700">

            {{ session('success') }}

        </div>

    @endif


    {{-- Error Message --}}
    @if (session('error'))

        <div class="mx-8 mt-6 rounded-xl
                    bg-red-50
                    border border-red-200
                    px-5 py-4
                    text-sm font-semibold
                    text-red-700">

            {{ session('error') }}

        </div>

    @endif


    {{-- Page Content --}}
    <main class="p-8">

        @yield('content')

    </main>

</div>


</div>

</body>

</html>
