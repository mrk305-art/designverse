
<section class="py-[30px] md:py-[30px] pb-[75px] md:pb-[100px] bg-white">

    <div class="w-[92%] max-w-[1200px] mx-auto">

        <div
            class="relative min-h-[360px]
                   overflow-hidden
                   flex items-center
                   px-6 py-12
                   sm:px-9 sm:py-[50px]
                   md:px-[70px] md:py-[65px]
                   rounded-[24px]
                   bg-gray-900"
        >

            {{-- CTA Content --}}
            <div class="relative z-10 max-w-[650px]">

                <span
                    class="inline-block mb-3.5
                           text-indigo-300
                           text-[11px]
                           font-extrabold
                           uppercase
                           tracking-[1.2px]"
                >
                    Ready to create?
                </span>


                <h2
                    class="max-w-[600px]
                           m-0
                           text-[34px]
                           sm:text-[40px]
                           md:text-[48px]
                           leading-[1.08]
                           tracking-[-2px]
                           font-bold
                           text-white"
                >
                    Your next great design
                    starts here.
                </h2>


                <p
                    class="max-w-[560px]
                           mt-[18px]
                           mb-7
                           text-sm
                           leading-7
                           text-gray-400"
                >
                    Join DesignVerse, showcase your work,
                    connect with creative people, and discover
                    ideas that inspire you.
                </p>


                {{-- CTA Actions --}}
                <div class="flex items-center gap-2.5 flex-wrap">

                    @guest

                        <a
                            href="{{ route('register') }}"
                            class="inline-flex items-center
                                   justify-center gap-2
                                   min-h-[45px]
                                   px-[18px]
                                   rounded-lg
                                   bg-white
                                   text-gray-900
                                   text-[13px]
                                   font-bold
                                   hover:bg-gray-100
                                   transition"
                        >
                            Join DesignVerse

                            <span class="text-[17px]">
                                →
                            </span>
                        </a>


                        <a
                            href="{{ route('login') }}"
                            class="inline-flex items-center
                                   justify-center
                                   min-h-[45px]
                                   px-[18px]
                                   rounded-lg
                                   border border-gray-700
                                   bg-transparent
                                   text-white
                                   text-[13px]
                                   font-bold
                                   hover:bg-gray-800
                                   transition"
                        >
                            Sign in
                        </a>

                    @else

                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-flex items-center
                                   justify-center gap-2
                                   min-h-[45px]
                                   px-[18px]
                                   rounded-lg
                                   bg-white
                                   text-gray-900
                                   text-[13px]
                                   font-bold
                                   hover:bg-gray-100
                                   transition"
                        >
                            Go to Dashboard

                            <span class="text-[17px]">
                                →
                            </span>
                        </a>

                    @endguest

                </div>

            </div>


            {{-- Decorative Area --}}
            <div
                class="absolute
                       top-0 right-0
                       w-full sm:w-[45%]
                       h-full
                       pointer-events-none
                       opacity-30 sm:opacity-100"
            >

                {{-- Circle One --}}
                <span
                    class="absolute
                           w-[330px] h-[330px]
                           -right-[90px] -top-[35px]
                           rounded-full
                           border border-white/10"
                ></span>


                {{-- Circle Two --}}
                <span
                    class="absolute
                           w-[240px] h-[240px]
                           right-5 top-[25px]
                           rounded-full
                           border border-white/10"
                ></span>


                {{-- Circle Three --}}
                <span
                    class="absolute
                           w-[145px] h-[145px]
                           right-[68px] top-[73px]
                           rounded-full
                           border border-white/10"
                ></span>


                {{-- Symbol --}}
                <div
                    class="absolute
                           right-[50px]
                           sm:right-[120px]
                           top-[75px]
                           sm:top-1/2
                           flex items-center
                           justify-center
                           w-[58px] h-[58px]
                           rounded-[15px]
                           border border-white/10
                           bg-white/5
                           text-indigo-300
                           text-[25px]
                           sm:-translate-y-1/2"
                >
                    ✦
                </div>

            </div>

        </div>

    </div>

</section>

