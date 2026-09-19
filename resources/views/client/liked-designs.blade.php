@extends('layouts.client')

@section('title', 'Liked Designs')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-gray-900">
            Liked Designs
        </h1>

        <p class="mt-2 text-gray-500">
            Designs you have liked on DesignVerse.
        </p>

    </div>


    {{-- Designs --}}
    @if ($likedDesigns->count())

        <div class="grid grid-cols-1
                    sm:grid-cols-2
                    lg:grid-cols-3
                    xl:grid-cols-4
                    gap-6">

            @foreach ($likedDesigns as $like)

                @php
                    $design = $like->design;
                @endphp

                @if ($design)

                    <div
                        class="group bg-white
                               border border-gray-200
                               rounded-2xl overflow-hidden
                               hover:shadow-lg
                               transition duration-300"
                    >

                        {{-- Image --}}
                        <a
                            href="{{ route(
                                'designs.show',
                                $design->id
                            ) }}"
                        >

                            <div
                                class="aspect-[4/3]
                                       bg-gray-100
                                       overflow-hidden"
                            >

                                @if ($design->images->count())

                                    <img
                                        src="{{ asset(
                                            'designs/' .
                                            $design->images->first()->image
                                        ) }}"
                                        alt="{{ $design->title }}"
                                        class="w-full h-full
                                               object-cover
                                               group-hover:scale-105
                                               transition duration-300"
                                    >

                                @else

                                    <div
                                        class="w-full h-full
                                               flex items-center
                                               justify-center
                                               text-gray-400"
                                    >
                                        No image
                                    </div>

                                @endif

                            </div>

                        </a>


                        {{-- Content --}}
                        <div class="p-5">

                            {{-- Category --}}
                            @if ($design->category)

                                <span
                                    class="inline-block
                                           text-xs font-semibold
                                           text-indigo-600
                                           bg-indigo-50
                                           px-3 py-1
                                           rounded-full"
                                >

                                    {{ $design->category->name }}

                                </span>

                            @endif


                            {{-- Title --}}
                            <a
                                href="{{ route(
                                    'designs.show',
                                    $design->id
                                ) }}"
                            >

                                <h2
                                    class="mt-3
                                           font-semibold
                                           text-gray-900
                                           truncate
                                           hover:text-indigo-600
                                           transition"
                                >

                                    {{ $design->title }}

                                </h2>

                            </a>


                            {{-- Designer --}}
                            @if ($design->user)

                                <div
                                    class="flex items-center
                                           gap-2 mt-4"
                                >

                                    @if ($design->user->profile_image)

                                        <img
                                            src="{{ asset(
                                                'profiles/' .
                                                $design->user->profile_image
                                            ) }}"
                                            alt="{{ $design->user->name }}"
                                            class="w-7 h-7
                                                   rounded-full
                                                   object-cover"
                                        >

                                    @else

                                        <div
                                            class="w-7 h-7
                                                   rounded-full
                                                   bg-gray-100
                                                   flex items-center
                                                   justify-center
                                                   text-xs
                                                   font-bold
                                                   text-gray-600"
                                        >

                                            {{ strtoupper(
                                                substr(
                                                    $design->user->name ?? 'U',
                                                    0,
                                                    1
                                                )
                                            ) }}

                                        </div>

                                    @endif


                                    <span
                                        class="text-sm
                                               text-gray-500"
                                    >

                                        {{ $design->user->name }}

                                    </span>

                                </div>

                            @endif


                            {{-- Like --}}
                            <div
                                class="flex items-center
                                       gap-2 mt-4
                                       text-sm text-red-500"
                            >

                                <span>
                                    ❤️
                                </span>

                                <span>
                                    Liked
                                </span>

                            </div>

                        </div>

                    </div>

                @endif

            @endforeach

        </div>


        {{-- Pagination --}}
        <div class="mt-8">

            {{ $likedDesigns->links() }}

        </div>

    @else

        {{-- Empty State --}}
        <div
            class="bg-white
                   border border-gray-200
                   rounded-2xl
                   p-12 text-center"
        >

            <div class="text-5xl mb-5">
                ❤️
            </div>


            <h2
                class="text-xl font-bold
                       text-gray-900"
            >

                No liked designs yet

            </h2>


            <p class="mt-2 text-gray-500">

                Designs you like will appear here.

            </p>


            <a
                href="{{ route('explore') }}"
                class="inline-flex
                       mt-6
                       rounded-xl
                       bg-indigo-600
                       px-6 py-3
                       text-sm font-semibold
                       text-white
                       hover:bg-indigo-700
                       transition"
            >

                Explore Designs

            </a>

        </div>

    @endif

</div>

@endsection