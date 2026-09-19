@extends('layouts.designer')

@section('content')

<div class="max-w-6xl mx-auto">


{{-- Header --}}
<div class="mb-8">

    <h1 class="text-3xl font-bold text-gray-900">
        Saved Designs
    </h1>

    <p class="mt-2 text-gray-500">
        Designs you've saved for later.
    </p>

</div>


{{-- Saved Designs --}}
@if ($savedDesigns->count())

    <div class="grid grid-cols-1 sm:grid-cols-2
                lg:grid-cols-3 gap-6">

        @foreach ($savedDesigns as $saved)

            @php
                $design = $saved->design;
            @endphp

            @if ($design)

                <div
                    class="group bg-white border
                           border-gray-200 rounded-2xl
                           overflow-hidden shadow-sm
                           hover:shadow-lg transition"
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
                                   bg-gray-100 overflow-hidden"
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

                        <a
                            href="{{ route(
                                'designs.show',
                                $design->id
                            ) }}"
                        >

                            <h2
                                class="font-bold text-gray-900
                                       hover:text-indigo-600 transition"
                            >
                                {{ $design->title }}
                            </h2>

                        </a>


                        {{-- Category --}}
                        @if ($design->category)

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $design->category->name }}
                            </p>

                        @endif


                        {{-- Designer --}}
                        <div
                            class="flex items-center gap-2 mt-4"
                        >

                            <div
                                class="w-8 h-8 rounded-full
                                       bg-indigo-100
                                       flex items-center
                                       justify-center
                                       text-indigo-600
                                       text-sm font-bold"
                            >
                                {{ strtoupper(
                                    substr(
                                        $design->user->name ?? 'U',
                                        0,
                                        1
                                    )
                                ) }}
                            </div>

                            <span
                                class="text-sm text-gray-600"
                            >
                                {{ $design->user->name ?? 'Unknown' }}
                            </span>

                        </div>


                        {{-- Stats --}}
                        <div
                            class="flex items-center gap-4
                                   mt-4 text-sm text-gray-500"
                        >

                            <span>
                                👁 {{ $design->views }}
                            </span>

                            <span>
                                ❤️
                                {{ $design->likes_count
                                    ?? $design->likes->count() }}
                            </span>

                        </div>


                        {{-- Actions --}}
                        <div
                            class="flex items-center gap-2 mt-5"
                        >

                            {{-- Add to Collection --}}
                            <a
                                href="{{ route(
                                    'designs.save',
                                    $design->id
                                ) }}"
                                class="flex-1 text-center
                                       rounded-xl
                                       bg-indigo-50
                                       px-4 py-2.5
                                       text-sm font-semibold
                                       text-indigo-700
                                       hover:bg-indigo-100
                                       transition"
                            >
                                📁 Collection
                            </a>


                            {{-- Unsave --}}
                            <form
                                action="{{ route(
                                    'designs.unsave',
                                    $design->id
                                ) }}"
                                method="POST"
                                class="flex-1"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="w-full rounded-xl
                                           bg-red-50
                                           px-4 py-2.5
                                           text-sm font-semibold
                                           text-red-600
                                           hover:bg-red-100
                                           transition"
                                    onclick="return confirm(
                                        'Remove this design from saved designs?'
                                    )"
                                >
                                    🔖 Unsave
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @endif

        @endforeach

    </div>


    {{-- Pagination --}}
    <div class="mt-8">
        {{ $savedDesigns->links() }}
    </div>


@else

    {{-- Empty State --}}
    <div
        class="bg-white border border-gray-200
               rounded-2xl p-12 text-center"
    >

        <div class="text-5xl mb-4">
            🔖
        </div>

        <h2 class="text-xl font-bold text-gray-900">
            No saved designs
        </h2>

        <p class="text-gray-500 mt-2">
            Designs you save will appear here.
        </p>

        <a
            href="{{ route('explore') }}"
            class="inline-flex items-center
                   mt-6 rounded-xl bg-indigo-600
                   px-5 py-3 text-sm font-semibold
                   text-white hover:bg-indigo-700
                   transition"
        >
            Explore Designs
        </a>

    </div>

@endif


</div>

@endsection
