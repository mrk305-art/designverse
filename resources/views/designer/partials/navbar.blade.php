<header class="sticky top-0 z-30 h-20 bg-white border-b border-gray-200">

    <div class="h-full px-8 flex items-center justify-between">

        <!-- Left -->
        <div class="flex items-center gap-6">

            <!-- Mobile Toggle -->
            <button class="lg:hidden p-2 rounded-lg hover:bg-gray-100">

                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

            </button>

            <!-- Search -->

            
<div class="relative">

    <form
        action="{{ route('explore') }}"
        method="GET"
    >

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search designs..."
            class="w-[420px] rounded-xl border border-gray-200
                   py-3 pl-12 pr-5
                   focus:ring-2 focus:ring-indigo-500
                   focus:outline-none"
        >

        <button
            type="submit"
            class="absolute left-0 top-0
                   w-12 h-full
                   flex items-center justify-center"
            aria-label="Search"
        >

            <svg
                class="w-5 h-5 text-gray-400"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"
                />

            </svg>

        </button>

    </form>

</div>



        </div>

        <!-- Right -->

        <div class="flex items-center gap-3">

            <button
                class="bg-indigo-600 hover:bg-indigo-700
                       text-white
                       px-5 py-3
                       rounded-xl
                       font-semibold
                       transition">

                + New Design

            </button>

            <button
                class="w-11 h-11 rounded-xl hover:bg-gray-100 flex items-center justify-center">

                💬

            </button>

          
<a
    href="{{ route('notifications.index') }}"
    class="relative inline-flex items-center justify-center
           w-11 h-11 rounded-xl hover:bg-gray-100 transition"
>
    🔔

    @php
        $unreadNotifications = auth()->user()
            ->notifications()
            ->where('is_read', false)
            ->count();
    @endphp

    @if ($unreadNotifications > 0)

        <span
            class="absolute -top-1 -right-1
                   min-w-5 h-5 px-1
                   flex items-center justify-center
                   rounded-full bg-red-500 text-white
                   text-xs font-bold"
        >
            {{ $unreadNotifications > 99 ? '99+' : $unreadNotifications }}
        </span>

    @endif

</a>



            <button
                class="w-11 h-11 rounded-xl hover:bg-gray-100 flex items-center justify-center">

                🌙

            </button>

            <div x-data="{ profile:false }" class="relative">

    <button
        @click="profile=!profile"
        class="flex items-center gap-3">

        <div
            class="w-11 h-11 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold">

            {{ strtoupper(substr(Auth::user()->name,0,1)) }}

        </div>

        <div>

            <h4 class="font-semibold">
                {{ Auth::user()->name }}
            </h4>

            <p class="text-sm text-gray-500">
                Designer
            </p>

        </div>

    </button>

    <div
        x-show="profile"
        @click.away="profile=false"
        x-transition
        class="absolute right-0 mt-3 w-60 bg-white rounded-2xl shadow-xl border overflow-hidden">

        <a href="#" class="block px-5 py-3 hover:bg-gray-100">
            👤 My Profile
        </a>

        <a href="#" class="block px-5 py-3 hover:bg-gray-100">
            ⚙ Account Settings
        </a>

       




        <hr>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                class="w-full text-left px-5 py-3 hover:bg-red-50 text-red-600">

                Logout

            </button>

        </form>

    </div>

</div>

</header>