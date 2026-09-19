
@extends('layouts.client')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-gray-900">
            My Collections
        </h1>

        <p class="mt-2 text-gray-500">
            Designs you have saved for later.
        </p>

    </div>


    {{-- Saved Designs --}}
    @if ($savedDesigns->count())

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            @foreach ($savedDesigns as $saved)

                @php
                    $design = $saved->design;
                @endphp

                @if ($design)

                    <div
                        class="bg-white border border-gray-200
                               rounded-2xl overflow-hidden
                               shadow-sm hover:shadow-xl
                               transition"
                    >

                        {{-- Image --}}
                        <a href="{{ route('designs.show', $design->id) }}">

                            @if ($design->images->count())

                                <img
                                    src="{{ asset(
                                        'designs/' .
                                        $design->images->first()->image
                                    ) }}"
                                    alt="{{ $design->title }}"
                                    class="w-full h-56 object-cover
                                           hover:scale-105 transition
                                           duration-300"
                                >

                            @else

                                <div
                                    class="w-full h-56 bg-gray-100
                                           flex items-center justify-center
                                           text-gray-400"
                                >
                                    No Image
                                </div>

                            @endif

                        </a>


                        {{-- Content --}}
                        <div class="p-5">

                            {{-- Category --}}
                            @if ($design->category)

                                <span
                                    class="inline-flex rounded-full
                                           bg-indigo-50 px-3 py-1
                                           text-xs font-semibold
                                           text-indigo-600"
                                >
                                    {{ $design->category->name }}
                                </span>

                            @endif


                            {{-- Title --}}
                            <h2 class="mt-3 text-lg font-bold text-gray-900">

                                <a
                                    href="{{ route(
                                        'designs.show',
                                        $design->id
                                    ) }}"
                                    class="hover:text-indigo-600 transition"
                                >
                                    {{ $design->title }}
                                </a>

                            </h2>


                            {{-- Designer --}}
                            <p class="mt-1 text-sm text-gray-500">

                                By
                                {{ $design->user->name ?? 'Unknown Designer' }}

                            </p>


                            {{-- Bottom --}}
                            <div
                                class="mt-5 flex items-center
                                       justify-between"
                            >

                                <span class="text-sm text-gray-500">
                                    ❤️ {{ $design->likes_count ?? 0 }}
                                </span>

                                <span class="text-xs text-gray-400">
                                    Saved {{ $saved->created_at->diffForHumans() }}
                                </span>

                            </div>


                            {{-- View --}}
                            <a
                                href="{{ route(
                                    'designs.show',
                                    $design->id
                                ) }}"
                                class="block text-center mt-4
                                       rounded-xl bg-indigo-600
                                       text-white py-2.5
                                       font-semibold
                                       hover:bg-indigo-700 transition"
                            >
                                View Design
                            </a>

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
                   rounded-2xl p-16 text-center"
        >

            <div class="text-6xl mb-5">
                🔖
            </div>

            <h2 class="text-2xl font-bold text-gray-900">
                No saved designs
            </h2>

            <p class="mt-2 text-gray-500">
                Designs you save will appear here.
            </p>

            <a
                href="{{ route('explore') }}"
                class="inline-block mt-6
                       rounded-xl bg-indigo-600
                       px-6 py-3 text-white
                       font-semibold
                       hover:bg-indigo-700 transition"
            >
                Explore Designs
            </a>

        </div>

    @endif

</div>

@endsection
