
<section class="py-24 bg-white">

    <div class="w-[92%] max-w-[1200px] mx-auto">

        {{-- Section Heading --}}
        <div class="flex flex-col md:flex-row md:items-end
                    md:justify-between gap-5 mb-10">

            <div>

                <span class="inline-block mb-2.5
                             text-indigo-500 text-[11px]
                             font-extrabold uppercase
                             tracking-[1.2px]">
                    Creative Community
                </span>

                <h2 class="m-0 text-[34px] leading-[1.15]
                           tracking-[-1.5px] font-bold text-gray-900">
                    Meet the Designers
                </h2>

                <p class="max-w-[540px] mt-2
                          text-sm leading-7 text-gray-500">
                    Discover talented creators and explore
                    the work they are sharing with the community.
                </p>

            </div>


            {{-- View All --}}
            <a
                href="{{ route('designers.index') }}"
                class="inline-flex items-center gap-2
                       flex-shrink-0
                       text-indigo-600 text-[13px]
                       font-bold hover:text-indigo-700
                       transition"
            >
                View all designers

                <span class="text-[17px]
                             transition-transform
                             duration-200
                             group-hover:translate-x-1">
                    →
                </span>

            </a>

        </div>


        @if($designers->count())

            {{-- Designers Grid --}}
            <div class="grid grid-cols-1
                        sm:grid-cols-2
                        lg:grid-cols-3
                        gap-4">

                @foreach($designers as $designer)

                    <a
                        href="{{ route(
                            'designer.profile',
                            $designer->id
                        ) }}"
                        class="relative flex items-center
                               gap-4 min-h-[100px]
                               p-[19px]
                               border border-gray-200
                               rounded-[14px]
                               bg-white
                               transition-all duration-300
                               hover:-translate-y-[3px]
                               hover:border-indigo-200
                               hover:shadow-[0_15px_35px_rgba(17,24,39,0.06)]"
                    >

                        {{-- Avatar --}}
                        <div
                            class="w-[55px] h-[55px]
                                   flex-shrink-0
                                   overflow-hidden
                                   flex items-center
                                   justify-center
                                   rounded-full
                                   bg-gradient-to-br
                                   from-indigo-50 to-violet-200
                                   text-indigo-500
                                   text-lg font-extrabold"
                        >

                            @if(!empty($designer->profile_photo_path))

                                <img
                                    src="{{ asset(
                                        'storage/' .
                                        $designer->profile_photo_path
                                    ) }}"
                                    alt="{{ $designer->name }}"
                                    class="w-full h-full
                                           object-cover block"
                                >

                            @else

                                <span>
                                    {{ strtoupper(
                                        substr(
                                            $designer->name,
                                            0,
                                            1
                                        )
                                    ) }}
                                </span>

                            @endif

                        </div>


                        {{-- Designer Information --}}
                        <div class="min-w-0 pr-5">

                            <h3
                                class="m-0 overflow-hidden
                                       text-gray-900
                                       text-sm font-bold
                                       whitespace-nowrap
                                       text-ellipsis"
                            >
                                {{ $designer->name }}
                            </h3>

                            <p
                                class="mt-1 text-[11px]
                                       text-gray-400"
                            >
                                Designer
                            </p>


                            {{-- Stats --}}
                            <div
                                class="flex items-center gap-1.5
                                       mt-2
                                       text-[10px]
                                       text-gray-500"
                            >

                                <span>
                                    {{ $designer->designs_count }}

                                    {{ $designer->designs_count == 1
                                        ? 'design'
                                        : 'designs'
                                    }}
                                </span>

                                <span class="text-gray-300">
                                    •
                                </span>

                                <span>
                                    {{ $designer->followers_count }}

                                    {{ $designer->followers_count == 1
                                        ? 'follower'
                                        : 'followers'
                                    }}
                                </span>

                            </div>

                        </div>


                        {{-- Arrow --}}
                        <span
                            class="absolute right-[18px]
                                   top-1/2
                                   -translate-y-1/2
                                   text-gray-300
                                   text-lg
                                   transition-all duration-200
                                   group-hover:text-indigo-500"
                        >
                            →
                        </span>

                    </a>

                @endforeach

            </div>

        @else

            {{-- Empty State --}}
            <div
                class="py-16 px-6
                       border border-dashed
                       border-gray-300
                       rounded-[15px]
                       text-center
                       bg-gray-50"
            >

                <div
                    class="w-12 h-12
                           flex items-center
                           justify-center
                           mx-auto mb-4
                           rounded-xl
                           bg-indigo-50
                           text-indigo-500
                           text-xl"
                >
                    ✦
                </div>

                <h3
                    class="m-0
                           text-[17px]
                           font-semibold
                           text-gray-700"
                >
                    No designers yet
                </h3>

                <p
                    class="max-w-[420px]
                           mx-auto mt-2
                           text-[13px]
                           leading-6
                           text-gray-400"
                >
                    Designers with published work will appear
                    here once they join the community.
                </p>

            </div>

        @endif

    </div>

</section>

