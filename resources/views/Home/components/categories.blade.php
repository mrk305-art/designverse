
<section class="py-5 bg-gray-50">

    <div class="w-[92%] max-w-[1200px] mx-auto">

        {{-- Section Heading --}}
        <div class="mb-10">

            <span
                class="inline-block mb-2.5
                       text-indigo-500
                       text-[11px]
                       font-extrabold
                       uppercase
                       tracking-[1.2px]"
            >
                Explore
            </span>

            <h2
                class="m-0
                       text-[34px]
                       leading-[1.15]
                       tracking-[-1.5px]
                       font-bold
                       text-gray-900"
            >
                Find Your Creative Space
            </h2>

            <p
                class="max-w-[540px]
                       mt-2
                       text-sm
                       leading-7
                       text-gray-500"
            >
                Explore different design categories and
                discover work that matches your interests.
            </p>

        </div>


        @if($categories->count())

            {{-- Categories Grid --}}
            <div
                class="grid
                       grid-cols-1
                       sm:grid-cols-2
                       lg:grid-cols-3
                       gap-4"
            >

                @foreach($categories as $category)

                    <a
                        href="{{ route(
                            'explore',
                            ['category' => $category->id]
                        ) }}"
                        class="group relative
                               flex items-center
                               gap-4
                               min-h-[105px]
                               p-5
                               overflow-hidden
                               border border-gray-200
                               rounded-[14px]
                               bg-white
                               transition-all duration-300
                               hover:-translate-y-[3px]
                               hover:border-indigo-200
                               hover:shadow-[0_15px_35px_rgba(17,24,39,0.06)]"
                    >

                        {{-- Category Icon --}}
                        <div
                            class="w-[50px] h-[50px]
                                   flex-shrink-0
                                   flex items-center
                                   justify-center
                                   rounded-xl
                                   bg-indigo-50
                                   text-indigo-500
                                   text-lg
                                   font-extrabold
                                   transition-all duration-300
                                   group-hover:bg-indigo-500
                                   group-hover:text-white
                                   group-hover:-rotate-1"
                        >
                            {{ strtoupper(
                                substr($category->name, 0, 1)
                            ) }}
                        </div>


                        {{-- Category Content --}}
                        <div
                            class="min-w-0
                                   pr-10"
                        >

                            <h3
                                class="m-0
                                       overflow-hidden
                                       text-gray-900
                                       text-[15px]
                                       font-bold
                                       whitespace-nowrap
                                       text-ellipsis"
                            >
                                {{ $category->name }}
                            </h3>

                            <p
                                class="mt-1.5
                                       text-xs
                                       text-gray-400"
                            >
                                {{ $category->designs_count }}

                                {{
                                    $category->designs_count == 1
                                    ? 'design'
                                    : 'designs'
                                }}
                            </p>

                        </div>


                        {{-- Arrow --}}
                        <span
                            class="absolute
                                   right-[19px]
                                   top-1/2
                                   -translate-y-1/2
                                   text-gray-300
                                   text-lg
                                   transition-all duration-200
                                   group-hover:text-indigo-500
                                   group-hover:translate-x-1"
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
                       bg-white"
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
                    No categories available
                </h3>

                <p
                    class="max-w-[420px]
                           mx-auto mt-2
                           text-[13px]
                           leading-6
                           text-gray-400"
                >
                    Categories will appear here once they are
                    added to DesignVerse.
                </p>

            </div>

        @endif

    </div>

</section>

