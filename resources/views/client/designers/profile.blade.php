@extends('layouts.client')

@section('title', $designer->name . ' - Designer')

@section('content')

<div class="max-w-6xl mx-auto space-y-8">


{{-- Profile Header --}}
<div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8">

    <div class="flex items-center justify-between gap-6">

        <div class="flex items-center gap-5">

            {{-- Avatar --}}
            @if ($designer->profile_image)

                <img
                    src="{{ asset('profiles/' . $designer->profile_image) }}"
                    alt="{{ $designer->name }}"
                    class="w-20 h-20 rounded-full object-cover
                           border border-gray-200"
                >

            @else

                <div
                    class="w-20 h-20 rounded-full bg-indigo-100
                           flex items-center justify-center
                           text-3xl font-bold text-indigo-600"
                >
                    {{ strtoupper(substr($designer->name ?? 'U', 0, 1)) }}
                </div>

            @endif


            {{-- Designer Info --}}
            <div>

                <h1 class="text-2xl font-bold text-gray-900">
                    {{ $designer->name }}
                </h1>
@if ($designer->bio)

    <p class="text-gray-500 mt-1 max-w-xl">
        {{ $designer->bio }}
    </p>

@else

    <p class="text-gray-500 mt-1">
        Designer
    </p>

@endif


                {{-- Stats --}}
                <div class="flex items-center gap-5 mt-3">

                    <span class="text-sm text-gray-600">

                        <strong class="text-gray-900">
                            {{ $designer->designs_count }}
                        </strong>

                        Designs

                    </span>


                    <a
                        href="{{ route(
                            'designer.followers',
                            $designer->id
                        ) }}"
                        class="text-sm text-gray-600
                               hover:text-indigo-600 transition"
                    >

                        <strong class="text-gray-900">
                            {{ $designer->followers_count }}
                        </strong>

                        Followers

                    </a>


                    <a
                        href="{{ route(
                            'designer.following',
                            $designer->id
                        ) }}"
                        class="text-sm text-gray-600
                               hover:text-indigo-600 transition"
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
        @auth

            @if (auth()->id() !== $designer->id)

                <form
                    action="{{ route(
                        'users.follow',
                        $designer->id
                    ) }}"
                    method="POST"
                >

                    @csrf

                    <button
                        type="submit"
                        class="rounded-xl px-6 py-3
                               font-semibold transition
                               {{ $isFollowing
                                    ? 'bg-gray-200 text-gray-800 hover:bg-gray-300'
                                    : 'bg-indigo-600 text-white hover:bg-indigo-700'
                               }}"
                    >

                        {{ $isFollowing
                            ? 'Following'
                            : '+ Follow'
                        }}

                    </button>

                </form>

            @endif

        @endauth

    </div>

</div>


{{-- Portfolio --}}
<div>

    <div class="flex items-center justify-between mb-5">

        <div>

            <h2 class="text-2xl font-bold text-gray-900">
                {{ $designer->name }}'s Designs
            </h2>

            <p class="text-gray-500 mt-1">
                Explore this designer's creative work.
            </p>

        </div>

    </div>


    {{-- Designs Grid --}}
    @if ($designer->designs->count())

        <div
            class="grid grid-cols-1
                   sm:grid-cols-2
                   lg:grid-cols-3
                   gap-6"
        >

            @foreach ($designer->designs as $design)

                <a
                    href="{{ route(
                        'designs.show',
                        $design->id
                    ) }}"
                    class="group bg-white border
                           border-gray-200 rounded-2xl
                           overflow-hidden shadow-sm
                           hover:shadow-lg transition"
                >

                    {{-- Image --}}
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
                                class="w-full h-full object-cover
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


                    {{-- Design Info --}}
                    <div class="p-5">

                        <h3 class="font-bold text-gray-900">
                            {{ $design->title }}
                        </h3>


                        @if ($design->category)

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $design->category->name }}
                            </p>

                        @endif


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

        <div
            class="bg-white border border-gray-200
                   rounded-2xl p-12 text-center"
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
