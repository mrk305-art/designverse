
<section class="relative overflow-hidden bg-white pt-4 pb-16 sm:pt-6 sm:pb-20 lg:pt-8 lg:pb-5">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="min-h-[560px] grid grid-cols-1 lg:grid-cols-[1.05fr_0.95fr] items-center gap-12 lg:gap-[70px]">


            {{-- Hero Content --}}
            <div class="max-w-[650px]">

                {{-- Badge --}}
                <div
                    class="inline-flex items-center gap-2.5
                           px-3.5 py-2
                           rounded-full
                           border border-gray-200
                           bg-white
                           text-xs font-bold text-indigo-500
                           shadow-sm"
                >
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>

                    The creative community for modern designers
                </div>


                {{-- Heading --}}
                <h1
                    class="max-w-[650px]
                           mt-6 mb-5
                           text-5xl sm:text-6xl lg:text-[72px]
                           leading-[1.02]
                           tracking-[-3.5px]
                           font-extrabold
                           text-gray-900"
                >
                    Where great
                    <span class="text-indigo-500">designs</span>
                    come to life.
                </h1>


                {{-- Description --}}
                <p
                    class="max-w-[570px]
                           mb-8
                           text-base sm:text-[17px]
                           leading-7 sm:leading-[1.75]
                           text-gray-500"
                >
                    Discover inspiring work from talented designers,
                    share your creativity, and connect with a community
                    built around great design.
                </p>


                {{-- Actions --}}
                <div class="flex items-center gap-3 flex-wrap">

                    <a
                        href="{{ route('explore') }}"
                        class="inline-flex items-center justify-center gap-2.5
                               min-h-12 px-5
                               rounded-lg
                               bg-gray-900 text-white
                               text-sm font-bold
                               hover:bg-gray-800
                               hover:-translate-y-0.5
                               transition-all duration-200"
                    >
                        Explore Designs

                        <span class="text-lg leading-none">
                            →
                        </span>
                    </a>


                    <a
                        href="{{ route('register') }}"
                        class="inline-flex items-center justify-center
                               min-h-12 px-5
                               rounded-lg
                               border border-gray-200
                               bg-white
                               text-sm font-bold text-gray-700
                               hover:border-indigo-200
                               hover:bg-indigo-50/30
                               hover:-translate-y-0.5
                               transition-all duration-200"
                    >
                        Start Creating
                    </a>

                </div>


                {{-- Trust --}}
                <div class="flex items-center gap-3.5 mt-8">

                    <div class="flex items-center">

                        <span
                            class="w-8 h-8 flex items-center justify-center
                                   rounded-full
                                   border-2 border-white
                                   bg-gray-200
                                   text-[10px] font-extrabold text-gray-700"
                        >
                            R
                        </span>

                        <span
                            class="w-8 h-8 -ml-1.5 flex items-center justify-center
                                   rounded-full
                                   border-2 border-white
                                   bg-gray-200
                                   text-[10px] font-extrabold text-gray-700"
                        >
                            A
                        </span>

                        <span
                            class="w-8 h-8 -ml-1.5 flex items-center justify-center
                                   rounded-full
                                   border-2 border-white
                                   bg-gray-200
                                   text-[10px] font-extrabold text-gray-700"
                        >
                            M
                        </span>

                        <span
                            class="w-8 h-8 -ml-1.5 flex items-center justify-center
                                   rounded-full
                                   border-2 border-white
                                   bg-gray-200
                                   text-[10px] font-extrabold text-gray-700"
                        >
                            S
                        </span>

                    </div>


                    <div class="flex flex-col gap-0.5">

                        <strong class="text-xs text-gray-700">
                            Join creative minds
                        </strong>

                        <small class="text-[11px] text-gray-400">
                            Designers are already sharing their work
                        </small>

                    </div>

                </div>

            </div>


            {{-- Hero Visual --}}
            <div class="relative min-h-[500px] w-full">


                {{-- Card One --}}
                <div
                    class="absolute top-6 left-5
                           w-[290px] p-2.5
                           rounded-2xl
                           border border-gray-200
                           bg-white
                           shadow-[0_25px_60px_rgba(17,24,39,0.12)]
                           -rotate-[5deg]"
                >

                    <div
                        class="h-[250px]
                               overflow-hidden
                               rounded-xl
                               bg-gradient-to-br from-indigo-50 to-violet-200
                               flex items-center justify-center"
                    >
                        <div
                            class="text-3xl font-extrabold tracking-tight
                                   text-gray-900/35"
                        >
                            Creative
                        </div>
                    </div>

                    <div class="flex flex-col gap-1 px-2 py-3.5 pb-1.5">

                        <strong class="text-[13px] text-gray-900">
                            Creative Interface
                        </strong>

                        <span class="text-[11px] text-gray-400">
                            UI / UX Design
                        </span>

                    </div>

                </div>


                {{-- Card Two --}}
                <div
                    class="absolute right-1 bottom-11
                           w-[290px] p-2.5
                           rounded-2xl
                           border border-gray-200
                           bg-white
                           shadow-[0_25px_60px_rgba(17,24,39,0.12)]
                           rotate-[5deg]"
                >

                    <div
                        class="h-[250px]
                               overflow-hidden
                               rounded-xl
                               bg-gradient-to-br from-gray-100 to-gray-200
                               flex items-center justify-center"
                    >
                        <div
                            class="text-3xl font-extrabold tracking-tight
                                   text-gray-900/35"
                        >
                            Studio
                        </div>
                    </div>

                    <div class="flex flex-col gap-1 px-2 py-3.5 pb-1.5">

                        <strong class="text-[13px] text-gray-900">
                            Modern Studio
                        </strong>

                        <span class="text-[11px] text-gray-400">
                            Brand Identity
                        </span>

                    </div>

                </div>


                {{-- Floating Card --}}
                <div
                    class="absolute right-0 top-[195px] z-10
                           flex items-center gap-3
                           px-4 py-3
                           rounded-xl
                           border border-gray-200
                           bg-white
                           shadow-[0_18px_40px_rgba(17,24,39,0.10)]"
                >

                    <div
                        class="w-[34px] h-[34px]
                               flex items-center justify-center
                               rounded-lg
                               bg-indigo-50
                               text-indigo-500
                               text-base"
                    >
                        ✦
                    </div>

                    <div class="flex flex-col gap-0.5">

                        <strong class="text-[11px] text-gray-700">
                            Fresh Inspiration
                        </strong>

                        <span class="text-[10px] text-gray-400">
                            New work every day
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

