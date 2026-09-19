
<section class="pt-[30px] pb-[90px] bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        {{-- Section Heading --}}
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-10">

            <div>

                <span
                    class="inline-block mb-2.5
                           text-[11px] font-extrabold
                           uppercase tracking-[1.2px]
                           text-indigo-500"
                >
                    Community Showcase
                </span>

                <h2
                    class="text-[34px] leading-tight
                           tracking-[-1.5px]
                           font-bold text-gray-900"
                >
                    Featured Designs
                </h2>

                <p
                    class="max-w-[540px]
                           mt-2
                           text-sm leading-7
                           text-gray-500"
                >
                    Discover creative work recently shared by
                    designers across DesignVerse.
                </p>

            </div>


            {{-- View All --}}
            <a
                href="{{ route('explore') }}"
                class="group inline-flex items-center gap-2
                       shrink-0
                       text-[13px] font-bold
                       text-indigo-600
                       hover:text-indigo-700
                       transition-colors duration-200"
            >
                Explore all designs

                <span
                    class="text-[17px]
                           transition-transform duration-200
                           group-hover:translate-x-1"
                >
                    →
                </span>
            </a>

        </div>


        {{-- Designs --}}
        @if($featuredDesigns->count())

            <div
                class="grid grid-cols-1
                       sm:grid-cols-2
                       lg:grid-cols-4
                       gap-x-5 gap-y-7"
            >

                @foreach($featuredDesigns as $design)

                    <article class="min-w-0">


                        {{-- Design Image --}}
                        <a
                            href="{{ route('designs.show', $design->id) }}"
                            class="group relative block
                                   h-[245px]
                                   overflow-hidden
                                   rounded-[13px]
                                   bg-dark-300"
                        >

                            @if($design->images->first())

                                <img
                                    src="{{ asset('designs/' . $design->images->first()->image) }}"
                                    alt="{{ $design->title }}"
                                    class="transition-all duration-500
brightness-[0.95]
group-hover:scale-[1.045]
group-hover:brightness-[0.88]"
                                >

                            @else

                                <div
                                    class="w-full h-full
                                           flex items-center justify-center
                                           bg-gradient-to-br from-gray-100 to-gray-200
                                           text-[13px] text-gray-400"
                                >
                                    No Image
                                </div>

                            @endif


                            {{-- Overlay --}}
                            <div
                                class="absolute inset-0
                                       flex items-end justify-end
                                       p-3.5
                                       bg-gradient-to-t
                                       from-black/40 to-transparent
                                       opacity-0
                                       group-hover:opacity-100
                                       transition-opacity duration-300"
                            >

                                <span
                                    class="px-3 py-2
                                           rounded-lg
                                           bg-white/95
                                           text-[11px] font-bold
                                           text-gray-900"
                                >
                                    View Design →
                                </span>

                            </div>

                        </a>


                        {{-- Card Content --}}
                        <div
                            class="flex items-start justify-between
                                   gap-3
                                   pt-3.5 px-0.5"
                        >

                            <div class="min-w-0">

                                <h3
                                    class="overflow-hidden
                                           text-sm font-bold
                                           leading-5
                                           text-gray-900
                                           whitespace-nowrap
                                           text-ellipsis"
                                >
                                    {{ $design->title }}
                                </h3>

                                <p
                                    class="mt-1
                                           overflow-hidden
                                           text-xs
                                           text-gray-400
                                           whitespace-nowrap
                                           text-ellipsis"
                                >
                                    {{ $design->user->name ?? 'Unknown Designer' }}
                                </p>

                            </div>


                            {{-- Likes --}}
                            <div
                                class="shrink-0
                                       pt-0.5
                                       text-[11px]
                                       text-gray-400"
                            >
                                ♥ {{ $design->likes_count }}
                            </div>

                        </div>


                        {{-- Category --}}
                        @if($design->category)

                            <span
                                class="inline-block
                                       max-w-full
                                       mt-2
                                       px-2 py-1.5
                                       overflow-hidden
                                       rounded-md
                                       bg-indigo-50
                                       text-[10px] font-bold
                                       text-indigo-500
                                       whitespace-nowrap
                                       text-ellipsis"
                            >
                                {{ $design->category->name }}
                            </span>

                        @endif

                    </article>

                @endforeach

            </div>

        @else

            {{-- Empty State --}}
            <div
                class="px-6 py-[70px]
                       border border-dashed border-gray-300
                       rounded-2xl
                       text-center
                       bg-gray-50"
            >

                <div
                    class="w-12 h-12
                           mx-auto mb-4
                           flex items-center justify-center
                           rounded-xl
                           bg-indigo-50
                           text-xl
                           text-indigo-500"
                >
                    ✦
                </div>

                <h3
                    class="text-[17px] font-bold
                           text-gray-700"
                >
                    No designs yet
                </h3>

                <p
                    class="max-w-[420px]
                           mx-auto mt-2
                           text-[13px]
                           leading-6
                           text-gray-400"
                >
                    Published designs will appear here once
                    designers start sharing their work.
                </p>

            </div>

        @endif

    </div>

</section>

