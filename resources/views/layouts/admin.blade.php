<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Admin Panel') - DesignVerse
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body class="bg-gray-50 text-gray-900">

<div class="min-h-screen flex">


    {{-- ================= SIDEBAR ================= --}}
    <aside class="w-64 bg-gray-900 text-white shrink-0 flex flex-col min-h-screen">


        {{-- Logo --}}
        <div class="px-6 py-6 border-b border-gray-800">

            <h1 class="text-2xl font-bold tracking-tight">
                DesignVerse
            </h1>

            <p class="text-sm text-gray-400 mt-1">
                Admin Panel
            </p>

        </div>

        


        {{-- Navigation --}}
        <nav class="flex-1 px-4 py-6 space-y-2">


            {{-- Dashboard --}}
            <a
                href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3
                       rounded-xl px-4 py-3
                       text-gray-300
                       hover:bg-gray-800
                       hover:text-white
                       transition"
            >

                <span class="text-lg">
                    📊
                </span>

                <span class="font-medium">
                    Dashboard
                </span>

            </a>


            {{-- Users --}}
            <a
                href="{{ route('admin.users.index') }}"
                class="flex items-center gap-3
                       rounded-xl px-4 py-3
                       text-gray-300
                       hover:bg-gray-800
                       hover:text-white
                       transition"
            >

                <span class="text-lg">
                    👥
                </span>

                <span class="font-medium">
                    Users
                </span>

            </a>


            {{-- Designs --}}
            <a
                href="{{ route('admin.designs.index') }}"
                class="flex items-center gap-3
                       rounded-xl px-4 py-3
                       text-gray-300
                       hover:bg-gray-800
                       hover:text-white
                       transition"
            >

                <span class="text-lg">
                    🎨
                </span>

                <span class="font-medium">
                    Designs
                </span>

            </a>


            {{-- Categories --}}
            <a
                href="{{ route('admin.categories.index') }}"
                class="flex items-center gap-3
                       rounded-xl px-4 py-3
                       text-gray-300
                       hover:bg-gray-800
                       hover:text-white
                       transition"
            >

                <span class="text-lg">
                    📁
                </span>

                <span class="font-medium">
                    Categories
                </span>

            </a>


            {{-- Reports --}}
           <a
    href="{{ route('admin.reports.index') }}"
    class="flex items-center gap-3
           rounded-xl px-4 py-3
           text-gray-300
           hover:bg-gray-800
           hover:text-white
           transition"
>
    <span class="text-lg">
        🚩
    </span>

    <span class="font-medium">
        Reports
    </span>
</a>

        </nav>


        {{-- ================= ADMIN PROFILE / LOGOUT ================= --}}
        <div class="border-t border-gray-800 p-4">


            {{-- Admin --}}
            <div class="flex items-center gap-3 mb-4 px-2">

                <div
                    class="w-10 h-10 rounded-full
                           bg-indigo-600
                           flex items-center justify-center
                           text-white font-bold"
                >
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>

                <div class="min-w-0">

                    <p class="text-sm font-semibold text-white truncate">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </p>

                    <p class="text-xs text-gray-400">
                        Administrator
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
                           text-gray-300
                           hover:bg-gray-800
                           hover:text-white
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
                    Admin Panel
                </p>

            </div>


            <div class="flex items-center gap-3">

                <div class="text-right">

                    <p class="text-sm font-semibold text-gray-900">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </p>

                    <p class="text-xs text-gray-500">
                        Administrator
                    </p>

                </div>


                <div
                    class="w-9 h-9 rounded-full
                           bg-indigo-100
                           flex items-center justify-center
                           text-indigo-600
                           font-bold"
                >
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>

            </div>

        </header>

        @if (session('success'))

    <div class="mb-6 rounded-xl bg-green-50
                border border-green-200
                px-5 py-4 text-sm
                font-semibold text-green-700">

        {{ session('success') }}

    </div>

@endif


@if (session('error'))

    <div class="mb-6 rounded-xl bg-red-50
                border border-red-200
                px-5 py-4 text-sm
                font-semibold text-red-700">

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