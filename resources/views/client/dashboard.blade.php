
@extends('layouts.client')

@section('title', 'Dashboard')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- ================= HEADER ================= --}}
    <div class="mb-10">

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">

            <div>

                <p class="text-sm font-medium text-indigo-600 mb-2">
                    Client Dashboard
                </p>

                <h1 class="text-3xl lg:text-4xl font-bold tracking-tight text-gray-900">
                    Welcome back, {{ auth()->user()->name }}
                </h1>

                <p class="mt-2 text-gray-500">
                    Discover, save and organize your favorite designs.
                </p>

            </div>

            <a
                href="{{ route('explore') }}"
                class="inline-flex items-center justify-center
                       rounded-xl bg-gray-900
                       px-5 py-3
                       text-sm font-semibold text-white
                       hover:bg-gray-800
                       transition"
            >
                Explore Designs
            </a>

        </div>

    </div>


    {{-- ================= STATS ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-10">


        {{-- Liked --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6
                    hover:shadow-sm transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Liked Designs
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-gray-900">
                        {{ $likedDesignsCount }}
                    </h2>

                </div>

                <div class="w-11 h-11 rounded-xl bg-rose-50
                            flex items-center justify-center text-xl">
                    ❤️
                </div>

            </div>

        </div>


        {{-- Saved --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6
                    hover:shadow-sm transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Saved Designs
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-gray-900">
                        {{ $savedDesignsCount }}
                    </h2>

                </div>

                <div class="w-11 h-11 rounded-xl bg-indigo-50
                            flex items-center justify-center text-xl">
                    🔖
                </div>

            </div>

        </div>


        {{-- Collections --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6
                    hover:shadow-sm transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Collections
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-gray-900">
                        {{ $collectionsCount }}
                    </h2>

                </div>

                <div class="w-11 h-11 rounded-xl bg-amber-50
                            flex items-center justify-center text-xl">
                    📁
                </div>

            </div>

        </div>


        {{-- Following --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6
                    hover:shadow-sm transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Following
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-gray-900">
                        {{ $followingCount }}
                    </h2>

                </div>

                <div class="w-11 h-11 rounded-xl bg-emerald-50
                            flex items-center justify-center text-xl">
                    👥
                </div>

            </div>

        </div>

    </div>


    {{-- ================= QUICK ACCESS ================= --}}
    <div class="mb-10">

        <div class="mb-5">

            <h2 class="text-xl font-bold text-gray-900">
                Quick Access
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Quickly access the things you use most.
            </p>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">


            {{-- Explore --}}
            <a
                href="{{ route('explore') }}"
                class="group bg-white border border-gray-200
                       rounded-2xl p-6
                       hover:border-indigo-200
                       hover:shadow-md
                       transition"
            >

                <div class="w-11 h-11 rounded-xl bg-indigo-50
                            flex items-center justify-center
                            text-xl mb-5">
                    🔍
                </div>

                <h3 class="font-semibold text-gray-900">
                    Explore Designs
                </h3>

                <p class="text-sm text-gray-500 mt-2 leading-6">
                    Discover creative work from talented designers.
                </p>

                <div class="mt-4 text-sm font-semibold text-indigo-600
                            group-hover:text-indigo-700">
                    Browse designs →
                </div>

            </a>


            {{-- Saved --}}
            <a
                href="{{ route('saved.designs') }}"
                class="group bg-white border border-gray-200
                       rounded-2xl p-6
                       hover:border-indigo-200
                       hover:shadow-md
                       transition"
            >

                <div class="w-11 h-11 rounded-xl bg-indigo-50
                            flex items-center justify-center
                            text-xl mb-5">
                    🔖
                </div>

                <h3 class="font-semibold text-gray-900">
                    Saved Designs
                </h3>

                <p class="text-sm text-gray-500 mt-2 leading-6">
                    Quickly access the designs you have saved.
                </p>

                <div class="mt-4 text-sm font-semibold text-indigo-600
                            group-hover:text-indigo-700">
                    View saved designs →
                </div>

            </a>


            {{-- Collections --}}
            <a
                href="{{ route('collections.index') }}"
                class="group bg-white border border-gray-200
                       rounded-2xl p-6
                       hover:border-indigo-200
                       hover:shadow-md
                       transition"
            >

                <div class="w-11 h-11 rounded-xl bg-indigo-50
                            flex items-center justify-center
                            text-xl mb-5">
                    📁
                </div>

                <h3 class="font-semibold text-gray-900">
                    My Collections
                </h3>

                <p class="text-sm text-gray-500 mt-2 leading-6">
                    Organize your favorite designs into collections.
                </p>

                <div class="mt-4 text-sm font-semibold text-indigo-600
                            group-hover:text-indigo-700">
                    View collections →
                </div>

            </a>

        </div>

    </div>


    {{-- ================= RECENT SAVED ================= --}}
    <div class="mb-10">

        <div class="flex items-end justify-between mb-5">

            <div>

                <h2 class="text-xl font-bold text-gray-900">
                    Recent Saved Designs
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Your latest saved designs.
                </p>

            </div>

            <a
                href="{{ route('saved.designs') }}"
                class="text-sm font-semibold text-indigo-600
                       hover:text-indigo-700"
            >
                View All →
            </a>

        </div>


        @if ($recentSavedDesigns->count())

            <div class="grid grid-cols-1 sm:grid-cols-2
                        lg:grid-cols-4 gap-5">

                @foreach ($recentSavedDesigns as $saved)

                    @php
                        $design = $saved->design;
                        $image = $design->images->first();
                    @endphp

                    <a
                        href="{{ route('designs.show', $design->id) }}"
                        class="group bg-white rounded-2xl
                               border border-gray-200
                               overflow-hidden
                               hover:shadow-md
                               hover:-translate-y-0.5
                               transition duration-200"
                    >

                        <div class="aspect-[4/3] bg-gray-100 overflow-hidden">

                            @if ($image)

                                <img
                                    src="{{ asset('designs/' . $image->image) }}"
                                    alt="{{ $design->title }}"
                                    class="w-full h-full object-cover
                                           group-hover:scale-105
                                           transition duration-500"
                                >

                            @else

                                <div class="w-full h-full flex items-center
                                            justify-center text-gray-400">
                                    No Image
                                </div>

                            @endif

                        </div>


                        <div class="p-4">

                            <h3 class="font-semibold text-gray-900 truncate">
                                {{ $design->title }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1 truncate">
                                By {{ $design->user->name ?? 'Unknown Designer' }}
                            </p>

                            @if ($design->category)

                                <span
                                    class="inline-block mt-3 px-2.5 py-1
                                           rounded-lg bg-gray-100
                                           text-xs font-medium text-gray-600"
                                >
                                    {{ $design->category->name }}
                                </span>

                            @endif

                        </div>

                    </a>

                @endforeach

            </div>

        @else

            <div class="bg-white border border-gray-200 rounded-2xl
                        p-12 text-center">

                <div class="w-14 h-14 mx-auto rounded-2xl bg-gray-100
                            flex items-center justify-center text-2xl">
                    🔖
                </div>

                <h3 class="mt-4 text-lg font-semibold text-gray-900">
                    No saved designs yet
                </h3>

                <p class="text-sm text-gray-500 mt-2">
                    Explore designs and save your favorites here.
                </p>

                <a
                    href="{{ route('explore') }}"
                    class="inline-flex mt-5 rounded-xl
                           bg-gray-900 px-5 py-2.5
                           text-sm font-semibold text-white
                           hover:bg-gray-800 transition"
                >
                    Explore Designs
                </a>

            </div>

        @endif

    </div>


    {{-- ================= RECENT LIKED ================= --}}
    <div class="mb-10">

        <div class="flex items-end justify-between mb-5">

            <div>

                <h2 class="text-xl font-bold text-gray-900">
                    Recent Liked Designs
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Designs you recently liked.
                </p>

            </div>

        </div>


        @if ($recentLikedDesigns->count())

            <div class="grid grid-cols-1 sm:grid-cols-2
                        lg:grid-cols-4 gap-5">

                @foreach ($recentLikedDesigns as $like)

                    @php
                        $design = $like->design;
                        $image = $design->images->first();
                    @endphp

                    <a
                        href="{{ route('designs.show', $design->id) }}"
                        class="group bg-white rounded-2xl
                               border border-gray-200
                               overflow-hidden
                               hover:shadow-md
                               hover:-translate-y-0.5
                               transition duration-200"
                    >

                        <div class="aspect-[4/3] bg-gray-100 overflow-hidden">

                            @if ($image)

                                <img
                                    src="{{ asset('designs/' . $image->image) }}"
                                    alt="{{ $design->title }}"
                                    class="w-full h-full object-cover
                                           group-hover:scale-105
                                           transition duration-500"
                                >

                            @else

                                <div class="w-full h-full flex items-center
                                            justify-center text-gray-400">
                                    No Image
                                </div>

                            @endif

                        </div>


                        <div class="p-4">

                            <h3 class="font-semibold text-gray-900 truncate">
                                {{ $design->title }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1 truncate">
                                By {{ $design->user->name ?? 'Unknown Designer' }}
                            </p>

                            @if ($design->category)

                                <span
                                    class="inline-block mt-3 px-2.5 py-1
                                           rounded-lg bg-gray-100
                                           text-xs font-medium text-gray-600"
                                >
                                    {{ $design->category->name }}
                                </span>

                            @endif

                        </div>

                    </a>

                @endforeach

            </div>

        @else

            <div class="bg-white border border-gray-200 rounded-2xl
                        p-12 text-center">

                <div class="w-14 h-14 mx-auto rounded-2xl bg-gray-100
                            flex items-center justify-center text-2xl">
                    ❤️
                </div>

                <h3 class="mt-4 text-lg font-semibold text-gray-900">
                    No liked designs yet
                </h3>

                <p class="text-sm text-gray-500 mt-2">
                    Like designs you love and they will appear here.
                </p>

                <a
                    href="{{ route('explore') }}"
                    class="inline-flex mt-5 rounded-xl
                           bg-gray-900 px-5 py-2.5
                           text-sm font-semibold text-white
                           hover:bg-gray-800 transition"
                >
                    Explore Designs
                </a>

            </div>

        @endif

    </div>


    {{-- ================= FOLLOWING DESIGNERS ================= --}}
    <div>

        <div class="flex items-end justify-between mb-5">

            <div>

                <h2 class="text-xl font-bold text-gray-900">
                    Following Designers
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Designers you recently followed.
                </p>

            </div>

            <a
                href="{{ route('client.following', auth()->id()) }}"
                class="text-sm font-semibold text-indigo-600
                       hover:text-indigo-700"
            >
                View All →
            </a>

        </div>


        @if ($recentFollowing->count())

            <div class="grid grid-cols-1 sm:grid-cols-2
                        lg:grid-cols-4 gap-5">

                @foreach ($recentFollowing as $follow)

                    @php
                        $designer = $follow->following;
                    @endphp

                    @if ($designer)

                        <a
                            href="{{ route('designer.profile', $designer->id) }}"
                            class="group bg-white rounded-2xl
                                   border border-gray-200
                                   p-5
                                   hover:shadow-md
                                   hover:-translate-y-0.5
                                   transition duration-200"
                        >

                            <div class="flex items-center gap-4">

                                @if ($designer->profile_image)

                                    <img
                                        src="{{ asset(
                                            'profiles/' .
                                            $designer->profile_image
                                        ) }}"
                                        alt="{{ $designer->name }}"
                                        class="w-14 h-14 rounded-full
                                               object-cover
                                               border border-gray-100"
                                    >

                                @else

                                    <div
                                        class="w-14 h-14 rounded-full
                                               bg-indigo-50
                                               flex items-center
                                               justify-center
                                               text-indigo-600
                                               font-bold text-lg"
                                    >
                                        {{ strtoupper(
                                            substr(
                                                $designer->name ?? 'D',
                                                0,
                                                1
                                            )
                                        ) }}
                                    </div>

                                @endif


                                <div class="min-w-0">

                                    <h3
                                        class="font-semibold
                                               text-gray-900
                                               truncate"
                                    >
                                        {{ $designer->name }}
                                    </h3>

                                    <p
                                        class="text-sm text-gray-500
                                               truncate mt-0.5"
                                    >
                                        {{ '@' . ($designer->username ?? 'designer') }}
                                    </p>

                                </div>

                            </div>


                            <div
                                class="mt-5 pt-4
                                       border-t border-gray-100
                                       flex items-center
                                       justify-between"
                            >

                                <span class="text-sm text-gray-500">
                                    Designer
                                </span>

                                <span
                                    class="text-sm font-semibold
                                           text-indigo-600
                                           group-hover:text-indigo-700"
                                >
                                    View Profile →
                                </span>

                            </div>

                        </a>

                    @endif

                @endforeach

            </div>

        @else

            <div class="bg-white border border-gray-200
                        rounded-2xl p-12 text-center">

                <div class="w-14 h-14 mx-auto rounded-2xl bg-gray-100
                            flex items-center justify-center text-2xl">
                    👥
                </div>

                <h3 class="mt-4 text-lg font-semibold text-gray-900">
                    You're not following anyone yet
                </h3>

                <p class="text-sm text-gray-500 mt-2">
                    Discover talented designers and follow your favorites.
                </p>

                <a
                    href="{{ route('designers.index') }}"
                    class="inline-flex mt-5 rounded-xl
                           bg-gray-900 px-5 py-2.5
                           text-sm font-semibold text-white
                           hover:bg-gray-800 transition"
                >
                    Discover Designers
                </a>

            </div>

        @endif

    </div>

</div>

@endsection

