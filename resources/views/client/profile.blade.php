
@extends('layouts.frontend')

@section('title', $client->name . ' - Profile')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">


{{-- =====================================================
     PROFILE HEADER
====================================================== --}}

<div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 sm:p-8">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">


        {{-- Client Information --}}
        <div class="flex items-start gap-4 sm:gap-5">


            {{-- Avatar --}}
            @if ($client->profile_image)

                <img
                    src="{{ asset('profiles/' . $client->profile_image) }}"
                    alt="{{ $client->name }}"
                    class="w-20 h-20 sm:w-24 sm:h-24 rounded-full
                           object-cover border border-gray-200
                           flex-shrink-0"
                >

            @else

                <div
                    class="w-20 h-20 sm:w-24 sm:h-24 rounded-full
                           bg-indigo-100
                           flex items-center justify-center
                           text-3xl sm:text-4xl
                           font-bold text-indigo-600
                           flex-shrink-0"
                >
                    {{ strtoupper(
                        substr($client->name ?? 'C', 0, 1)
                    ) }}
                </div>

            @endif


            {{-- Info --}}
            <div class="min-w-0">

                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                    {{ $client->name }}
                </h1>


                @if ($client->username)

                    <p class="text-sm text-gray-500 mt-1">
                        {{ '@' . $client->username }}
                    </p>

                @endif


                @if ($client->bio)

                    <p class="text-gray-500 mt-2 max-w-xl leading-relaxed">
                        {{ $client->bio }}
                    </p>

                @else

                    <p class="text-gray-500 mt-2">
                        Client
                    </p>

                @endif


                {{-- Stats --}}
                <div class="flex flex-wrap items-center
                            gap-x-5 gap-y-2 mt-4">


                    {{-- Collections --}}
                    <span class="text-sm text-gray-600">

                        <strong class="text-gray-900">
                            {{ $client->collections_count }}
                        </strong>

                        Collections

                    </span>


                    {{-- Followers --}}
                    <a
                        href="{{ route(
                            'client.followers',
                            $client->id
                        ) }}"
                        class="text-sm text-gray-600
                               hover:text-indigo-600
                               transition"
                    >

                        <strong class="text-gray-900">
                            {{ $client->followers_count }}
                        </strong>

                        Followers

                    </a>


                    {{-- Following --}}
                    <a
                        href="{{ route(
                            'client.following',
                            $client->id
                        ) }}"
                        class="text-sm text-gray-600
                               hover:text-indigo-600
                               transition"
                    >

                        <strong class="text-gray-900">
                            {{ $client->following_count }}
                        </strong>

                        Following

                    </a>

                </div>

            </div>

        </div>


        {{-- Follow Button --}}
        @if (auth()->check() && auth()->id() !== $client->id)

            <form
                action="{{ route(
                    'users.follow',
                    $client->id
                ) }}"
                method="POST"
                class="flex-shrink-0"
            >

                @csrf

                <button
                    type="submit"
                    class="w-full md:w-auto
                           rounded-xl px-6 py-3
                           font-semibold transition
                           {{
                               $isFollowing
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


        @elseif (!auth()->check())

            <a
                href="{{ route('login') }}"
                class="w-full md:w-auto
                       inline-flex items-center justify-center
                       rounded-xl px-6 py-3
                       bg-indigo-600 text-white
                       font-semibold
                       hover:bg-indigo-700 transition"
            >
                + Follow
            </a>

        @endif

    </div>

</div>



{{-- =====================================================
     COLLECTIONS
====================================================== --}}

<div>


    {{-- Section Heading --}}
    <div class="flex flex-col sm:flex-row
                sm:items-end sm:justify-between
                gap-3 mb-6">

        <div>

            <h2 class="text-2xl sm:text-3xl
                       font-bold text-gray-900">

                {{ $client->name }}'s Collections

            </h2>

            <p class="text-gray-500 mt-1">

                Explore collections created by this client.

            </p>

        </div>

    </div>



    {{-- Collections Grid --}}
    @if ($client->collections->count())

        <div
            class="grid grid-cols-1
                   sm:grid-cols-2
                   lg:grid-cols-3
                   gap-6"
        >


            @foreach ($client->collections as $collection)

                <a
                    href="{{ route(
                        'collections.show',
                        $collection->id
                    ) }}"
                    class="group
                           bg-white
                           border border-gray-200
                           rounded-2xl
                           p-6
                           shadow-sm
                           hover:shadow-lg
                           hover:-translate-y-1
                           transition duration-300"
                >


                    {{-- Collection Icon --}}
                    <div
                        class="w-12 h-12
                               rounded-xl
                               bg-indigo-50
                               flex items-center
                               justify-center
                               text-2xl
                               mb-5"
                    >
                        📁
                    </div>


                    {{-- Collection Name --}}
                    <h3
                        class="font-bold
                               text-lg
                               text-gray-900
                               truncate
                               group-hover:text-indigo-600
                               transition"
                    >

                        {{ $collection->name }}

                    </h3>


                    {{-- Description --}}
                    @if ($collection->description)

                        <p
                            class="text-sm
                                   text-gray-500
                                   mt-2
                                   line-clamp-2"
                        >

                            {{ $collection->description }}

                        </p>

                    @else

                        <p class="text-sm text-gray-400 mt-2">

                            No description available.

                        </p>

                    @endif


                    {{-- View --}}
                    <div
                        class="mt-5
                               text-sm
                               font-semibold
                               text-indigo-600
                               group-hover:text-indigo-700"
                    >

                        View Collection →

                    </div>

                </a>

            @endforeach

        </div>


    @else


        {{-- Empty Collections --}}
        <div
            class="bg-white
                   border border-gray-200
                   rounded-2xl
                   p-10 sm:p-12
                   text-center"
        >

            <div class="text-5xl mb-4">
                📁
            </div>


            <h3
                class="text-lg
                       font-semibold
                       text-gray-800"
            >

                No collections yet

            </h3>


            <p class="text-gray-500 mt-1">

                {{ $client->name }}
                hasn't created any collections yet.

            </p>

        </div>

    @endif

</div>


</div>

@endsection

