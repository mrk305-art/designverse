@extends('layouts.frontend')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">


{{-- =====================================================
     PROFILE HEADER
====================================================== --}}

<div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 sm:p-8">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

        {{-- Designer Information --}}
        <div class="flex items-start gap-4 sm:gap-5">

            {{-- Avatar --}}
            @if ($designer->profile_image)

                <img
                    src="{{ asset('profiles/' . $designer->profile_image) }}"
                    alt="{{ $designer->name }}"
                    class="w-20 h-20 sm:w-24 sm:h-24 rounded-full object-cover
                           border border-gray-200 flex-shrink-0"
                >

            @else

                <div
                    class="w-20 h-20 sm:w-24 sm:h-24 rounded-full
                           bg-indigo-100 flex items-center justify-center
                           text-3xl sm:text-4xl font-bold text-indigo-600
                           flex-shrink-0"
                >
                    {{ strtoupper(substr($designer->name ?? 'U', 0, 1)) }}
                </div>

            @endif


            {{-- Info --}}
            <div class="min-w-0">

                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                    {{ $designer->name }}
                </h1>


                @if ($designer->bio)

                    <p class="text-gray-500 mt-1 max-w-xl leading-relaxed">
                        {{ $designer->bio }}
                    </p>

                @else

                    <p class="text-gray-500 mt-1">
                        Designer
                    </p>

                @endif


                {{-- Stats --}}
                <div class="flex flex-wrap items-center gap-x-5 gap-y-2 mt-4">

                    <span class="text-sm text-gray-600">
                        <strong class="text-gray-900">
                            {{ $designer->designs_count }}
                        </strong>
                        Designs
                    </span>


                    <a
                        href="{{ route('designer.followers', $designer->id) }}"
                        class="text-sm text-gray-600 hover:text-indigo-600 transition"
                    >
                        <strong class="text-gray-900">
                            {{ $designer->followers_count }}
                        </strong>
                        Followers
                    </a>


                    <a
                        href="{{ route('designer.following', $designer->id) }}"
                        class="text-sm text-gray-600 hover:text-indigo-600 transition"
                    >
                        <strong class="text-gray-900">
                            {{ $designer->following_count }}
                        </strong>
                        Following
                    </a>

                </div>

            </div>

        </div>


        {{-- Follow Button --}}
        @if (auth()->check() && auth()->id() !== $designer->id)

            <form
                action="{{ route('users.follow', $designer->id) }}"
                method="POST"
                class="flex-shrink-0"
            >
                @csrf

                <button
                    type="submit"
                    class="w-full md:w-auto rounded-xl px-6 py-3
                           font-semibold transition
                           {{ $isFollowing
                                ? 'bg-gray-200 text-gray-800 hover:bg-gray-300'
                                : 'bg-indigo-600 text-white hover:bg-indigo-700'
                           }}"
                >
                    {{ $isFollowing ? 'Following' : '+ Follow' }}
                </button>

            </form>

        @elseif (!auth()->check())

            <a
                href="{{ route('login') }}"
                class="w-full md:w-auto inline-flex items-center justify-center
                       rounded-xl px-6 py-3
                       bg-indigo-600 text-white
                       font-semibold hover:bg-indigo-700 transition"
            >
                + Follow
            </a>

        @endif

    </div>

</div>


{{-- =====================================================
     PORTFOLIO
====================================================== --}}

<div>

    {{-- Section Heading --}}
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between
                gap-3 mb-6">

        <div>

            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">
                {{ $designer->name }}'s Designs
            </h2>

            <p class="text-gray-500 mt-1">
                Explore this designer's creative work.
            </p>

        </div>

    </div>


    {{-- =================================================
         DESIGNS GRID
    ================================================== --}}

    @if ($designer->designs->count())

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach ($designer->designs as $design)

                <a
                    href="{{ route('designs.show', $design->id) }}"
                    class="group bg-white border border-gray-200
                           rounded-2xl overflow-hidden shadow-sm
                           hover:shadow-lg hover:-translate-y-1
                           transition duration-300"
                >

                    {{-- Design Image --}}
                    <div class="aspect-[4/3] bg-gray-100 overflow-hidden">

                        @if ($design->images->count())

                            <img
                                src="{{ asset('designs/' . $design->images->first()->image) }}"
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
                                No image
                            </div>

                        @endif

                    </div>


                    {{-- Design Information --}}
                    <div class="p-5">

                        <h3
                            class="font-bold text-gray-900 truncate"
                        >
                            {{ $design->title }}
                        </h3>


                        @if ($design->category)

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $design->category->name }}
                            </p>

                        @endif


                        {{-- Design Stats --}}
                        <div class="flex items-center gap-4 mt-4">

                            <span class="text-sm text-gray-500">
                                👁 {{ $design->views }}
                            </span>

                            <span class="text-sm text-gray-500">
                                ❤️ {{ $design->likes_count }}
                            </span>

                        </div>

                    </div>

                </a>

            @endforeach

        </div>

    @else

        {{-- Empty Portfolio --}}
        <div
            class="bg-white border border-gray-200
                   rounded-2xl p-10 sm:p-12 text-center"
        >

            <div class="text-5xl mb-4">
                🎨
            </div>

            <h3 class="text-lg font-semibold text-gray-800">
                No designs yet
            </h3>

            <p class="text-gray-500 mt-1">
                This designer hasn't uploaded any designs yet.
            </p>

        </div>

    @endif

</div>


</div>

@endsection
