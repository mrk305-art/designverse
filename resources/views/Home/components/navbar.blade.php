
<header class="w-full bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="h-[74px] flex items-center justify-between">

            {{-- Logo --}}
            <a
                href="{{ route('home') }}"
                class="inline-flex items-center text-[25px] font-extrabold tracking-tight shrink-0"
            >
                <span class="text-gray-900">Design</span>
                <span class="text-indigo-500">Verse</span>
            </a>


            {{-- Navigation --}}
            <nav class="hidden md:flex items-center gap-8 ml-10">

                <a
                    href="{{ route('home') }}"
                    class="relative py-7 text-sm font-semibold text-gray-900
                           after:absolute after:left-0 after:right-0 after:bottom-4
                           after:h-0.5 after:bg-indigo-500 after:rounded-full"
                >
                    Home
                </a>

                <a
                    href="{{ route('explore') }}"
                    class="py-7 text-sm font-semibold text-gray-500
                           hover:text-gray-900 transition-colors duration-200"
                >
                    Explore
                </a>

                <a
                    href="{{ route('designers.index') }}"
                    class="py-7 text-sm font-semibold text-gray-500
                           hover:text-gray-900 transition-colors duration-200"
                >
                    Designers
                </a>

                <a
    href="{{ route('clients.index') }}"
    class="py-7 text-sm font-semibold text-gray-500
           hover:text-gray-900 transition-colors duration-200"
>
    Clients
</a>

                <a
                    href="{{ route('explore') }}"
                    class="py-7 text-sm font-semibold text-gray-500
                           hover:text-gray-900 transition-colors duration-200"
                >
                    Categories
                </a>

            </nav>


            {{-- Authentication --}}
            <div class="flex items-center gap-2.5">

                @auth

                    <a
                        href="{{ url('/dashboard') }}"
                        class="px-4 py-2.5 rounded-lg
                               text-sm font-semibold text-gray-700
                               hover:bg-gray-100
                               transition-colors duration-200"
                    >
                        Dashboard
                    </a>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="hidden sm:inline-flex
                               px-4 py-2.5 rounded-lg
                               text-sm font-semibold text-gray-700
                               hover:bg-gray-100
                               transition-colors duration-200"
                    >
                        Login
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="px-4 sm:px-[17px] py-2.5 rounded-lg
                               bg-gray-900 text-white
                               text-sm font-bold
                               hover:bg-gray-800
                               transition-all duration-200
                               hover:-translate-y-0.5"
                    >
                        <span class="hidden sm:inline">
                            Join DesignVerse
                        </span>

                        <span class="sm:hidden">
                            Join
                        </span>
                    </a>

                @endauth

            </div>

        </div>

    </div>
</header>

