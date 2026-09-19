@extends('layouts.frontend')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


{{-- =====================================================
     HEADER
====================================================== --}}

<div class="mb-8">

    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">
        Explore
    </h1>

    <p class="mt-2 text-gray-500">
        Discover creative designs from our community.
    </p>

</div>


{{-- =====================================================
     SEARCH & FILTER
====================================================== --}}

<form
    action="{{ route('explore') }}"
    method="GET"
    class="bg-white border border-gray-200
           rounded-2xl p-4 sm:p-5 mb-8 shadow-sm"
>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

        {{-- Search --}}
        <div class="md:col-span-2">

            <label
                for="search"
                class="block text-sm font-semibold
                       text-gray-700 mb-2"
            >
                Search
            </label>

            <input
                id="search"
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search designs..."
                class="w-full rounded-xl border border-gray-300
                       px-4 py-3 text-gray-900
                       placeholder-gray-400
                       focus:border-indigo-500
                       focus:ring-2 focus:ring-indigo-200
                       focus:outline-none transition"
            >

        </div>


        {{-- Category --}}
        <div>

            <label
                for="category"
                class="block text-sm font-semibold
                       text-gray-700 mb-2"
            >
                Category
            </label>

            <select
                id="category"
                name="category"
                class="w-full rounded-xl border border-gray-300
                       bg-white px-4 py-3
                       text-gray-900
                       focus:border-indigo-500
                       focus:ring-2 focus:ring-indigo-200
                       focus:outline-none transition"
            >

                <option value="">
                    All Categories
                </option>

                @foreach ($categories as $category)

                    <option
                        value="{{ $category->id }}"
                        {{ request('category') == $category->id
                            ? 'selected'
                            : ''
                        }}
                    >
                        {{ $category->name }}
                    </option>

                @endforeach

            </select>

        </div>


        {{-- Sort --}}
        <div>

            <label
                for="sort"
                class="block text-sm font-semibold
                       text-gray-700 mb-2"
            >
                Sort By
            </label>

            <select
                id="sort"
                name="sort"
                class="w-full rounded-xl border border-gray-300
                       bg-white px-4 py-3
                       text-gray-900
                       focus:border-indigo-500
                       focus:ring-2 focus:ring-indigo-200
                       focus:outline-none transition"
            >

                <option
                    value="latest"
                    {{ request('sort', 'latest') === 'latest'
                        ? 'selected'
                        : ''
                    }}
                >
                    Latest
                </option>

                <option
                    value="popular"
                    {{ request('sort') === 'popular'
                        ? 'selected'
                        : ''
                    }}
                >
                    Most Liked
                </option>

                <option
                    value="views"
                    {{ request('sort') === 'views'
                        ? 'selected'
                        : ''
                    }}
                >
                    Most Viewed
                </option>

            </select>

        </div>

    </div>


    {{-- Buttons --}}
    <div class="flex flex-col-reverse sm:flex-row
                sm:items-center sm:justify-end
                gap-3 mt-5">

        <a
            href="{{ route('explore') }}"
            class="inline-flex items-center justify-center
                   px-5 py-2.5 rounded-xl
                   border border-gray-300
                   text-gray-700 font-semibold
                   hover:bg-gray-50 transition"
        >
            Clear
        </a>

        <button
            type="submit"
            class="inline-flex items-center justify-center
                   px-6 py-2.5 rounded-xl
                   bg-indigo-600 text-white
                   font-semibold hover:bg-indigo-700
                   transition"
        >
            Search
        </button>

    </div>

</form>


{{-- =====================================================
     RESULTS COUNT
====================================================== --}}

<div class="mb-5">

    <p class="text-sm text-gray-500">

        Showing

        <span class="font-semibold text-gray-800">
            {{ $designs->total() }}
        </span>

        designs

    </p>

</div>


{{-- =====================================================
     DESIGN GRID
====================================================== --}}

@if ($designs->count())

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach ($designs as $design)

            <a
                href="{{ route('designs.show', $design->id) }}"
                class="group bg-white border border-gray-200
                       rounded-2xl overflow-hidden
                       shadow-sm hover:shadow-xl
                       hover:-translate-y-1
                       transition duration-300"
            >

                {{-- Image --}}
                <div
                    class="aspect-[4/3]
                           bg-gray-100 overflow-hidden"
                >

                    @if ($design->images->first())

                        <img
                            src="{{ asset(
                                'designs/' .
                                $design->images->first()->image
                            ) }}"
                            alt="{{ $design->title }}"
                            class="w-full h-full object-cover
                                   group-hover:scale-105
                                   transition duration-500"
                        >

                    @else

                        <div
                            class="w-full h-full flex items-center
                                   justify-center text-gray-400"
                        >
                            No Image
                        </div>

                    @endif

                </div>


                {{-- Design Information --}}
                <div class="p-5">

                    <div class="flex items-start
                                justify-between gap-3">

                        <div class="min-w-0">

                            <h2
                                class="font-bold text-gray-900
                                       group-hover:text-indigo-600
                                       transition truncate"
                            >
                                {{ $design->title }}
                            </h2>

                            <p class="text-sm text-gray-500 mt-1 truncate">
                                by {{ $design->user->name }}
                            </p>

                        </div>


                        @if ($design->category)

                            <span
                                class="flex-shrink-0
                                       text-xs font-semibold
                                       bg-gray-100 text-gray-600
                                       rounded-full px-3 py-1
                                       max-w-[130px] truncate"
                            >
                                {{ $design->category->name }}
                            </span>

                        @endif

                    </div>


                    {{-- Stats --}}
                    <div class="flex items-center gap-5 mt-4">

                        <span class="text-sm text-gray-500">
                            👁 {{ $design->views }}
                        </span>

                        <span class="text-sm text-gray-500">
                            ❤️ {{ $design->likes->count() }}
                        </span>

                    </div>

                </div>

            </a>

        @endforeach

    </div>


    {{-- =================================================
         PAGINATION
    ================================================== --}}

    <div class="mt-8">

        {{ $designs->links() }}

    </div>


@else

    {{-- =================================================
         NO RESULTS
    ================================================== --}}

    <div
        class="bg-white border border-gray-200
               rounded-2xl p-10 sm:p-16 text-center"
    >

        <div class="text-5xl sm:text-6xl mb-5">
            🔍
        </div>

        <h2 class="text-xl font-bold text-gray-800">
            No designs found
        </h2>

        <p class="text-gray-500 mt-2">
            Try another search or category.
        </p>

    </div>

@endif


</div>

@endsection
