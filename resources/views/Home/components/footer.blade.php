
<footer class="border-t border-gray-200 bg-white">

    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        {{-- Footer Main --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-10 lg:gap-12 py-16">

            {{-- Brand --}}
            <div class="lg:col-span-2 max-w-sm">

                <a
                    href="{{ url('/') }}"
                    class="inline-flex items-center text-[23px] font-extrabold tracking-tight"
                >
                    <span class="text-gray-900">Design</span>
                    <span class="text-indigo-500">Verse</span>
                </a>

                <p class="max-w-xs mt-4 text-sm leading-7 text-gray-400">
                    A creative community where designers
                    discover, create, and inspire.
                </p>

            </div>


            {{-- Platform Links --}}
            <div class="flex flex-col items-start gap-3">

                <h3 class="mb-2 text-xs font-extrabold text-gray-700">
                    Platform
                </h3>

                <a
                    href="{{ route('explore') }}"
                    class="text-xs text-gray-400 hover:text-indigo-500 transition-colors duration-200"
                >
                    Explore
                </a>

                <a
                    href="{{ route('designers.index') }}"
                    class="text-xs text-gray-400 hover:text-indigo-500 transition-colors duration-200"
                >
                    Designers
                </a>

                <a
                    href="{{ route('explore') }}"
                    class="text-xs text-gray-400 hover:text-indigo-500 transition-colors duration-200"
                >
                    Categories
                </a>

            </div>


            {{-- Community Links --}}
            <div class="flex flex-col items-start gap-3">

                <h3 class="mb-2 text-xs font-extrabold text-gray-700">
                    Community
                </h3>

                <a
                    href="{{ route('register') }}"
                    class="text-xs text-gray-400 hover:text-indigo-500 transition-colors duration-200"
                >
                    Join DesignVerse
                </a>

                <a
                    href="{{ route('login') }}"
                    class="text-xs text-gray-400 hover:text-indigo-500 transition-colors duration-200"
                >
                    Sign in
                </a>

                <a
                    href="#"
                    class="text-xs text-gray-400 hover:text-indigo-500 transition-colors duration-200"
                >
                    About us
                </a>

            </div>


            {{-- Support Links --}}
            <div class="flex flex-col items-start gap-3">

                <h3 class="mb-2 text-xs font-extrabold text-gray-700">
                    Support
                </h3>

                <a
                    href="#"
                    class="text-xs text-gray-400 hover:text-indigo-500 transition-colors duration-200"
                >
                    Help Center
                </a>

                <a
                    href="#"
                    class="text-xs text-gray-400 hover:text-indigo-500 transition-colors duration-200"
                >
                    Privacy
                </a>

                <a
                    href="#"
                    class="text-xs text-gray-400 hover:text-indigo-500 transition-colors duration-200"
                >
                    Terms
                </a>

            </div>

        </div>


        {{-- Footer Bottom --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5 py-5 border-t border-gray-200">

            <p class="text-[11px] text-gray-400">
                © {{ date('Y') }} DesignVerse. All rights reserved.
            </p>


            {{-- Social Links --}}
            <div class="flex items-center gap-2">

                <a
                    href="#"
                    aria-label="Instagram"
                    class="w-[30px] h-[30px] flex items-center justify-center
                           rounded-lg border border-gray-200
                           text-[9px] font-extrabold text-gray-500
                           hover:border-indigo-200
                           hover:bg-indigo-50
                           hover:text-indigo-500
                           transition-all duration-200"
                >
                    IG
                </a>

                <a
                    href="#"
                    aria-label="Dribbble"
                    class="w-[30px] h-[30px] flex items-center justify-center
                           rounded-lg border border-gray-200
                           text-[9px] font-extrabold text-gray-500
                           hover:border-indigo-200
                           hover:bg-indigo-50
                           hover:text-indigo-500
                           transition-all duration-200"
                >
                    DB
                </a>

                <a
                    href="#"
                    aria-label="Twitter"
                    class="w-[30px] h-[30px] flex items-center justify-center
                           rounded-lg border border-gray-200
                           text-[9px] font-extrabold text-gray-500
                           hover:border-indigo-200
                           hover:bg-indigo-50
                           hover:text-indigo-500
                           transition-all duration-200"
                >
                    X
                </a>

            </div>

        </div>

    </div>

</footer>

