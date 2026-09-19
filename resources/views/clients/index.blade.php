@extends('layouts.frontend')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


{{-- Header --}}
<div class="mb-8">

    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">
        Clients
    </h1>

    <p class="mt-2 text-gray-500">
        Discover clients and explore their collections.
    </p>

</div>


{{-- Search --}}
<form
    action="{{ route('clients.index') }}"
    method="GET"
    class="bg-white border border-gray-200
           rounded-2xl p-4 sm:p-5 mb-8 shadow-sm"
>

    <div class="flex flex-col sm:flex-row gap-3">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search clients..."
            class="flex-1 rounded-xl border border-gray-300
                   px-4 py-3 text-gray-900
                   placeholder-gray-400
                   focus:border-indigo-500
                   focus:ring-2 focus:ring-indigo-200
                   focus:outline-none transition"
        >

        <div class="flex gap-3">

            <button
                type="submit"
                class="flex-1 sm:flex-none px-6 py-3
                       rounded-xl bg-indigo-600 text-white
                       font-semibold hover:bg-indigo-700
                       transition"
            >
                Search
            </button>

            @if (request('search'))

                <a
                    href="{{ route('clients.index') }}"
                    class="flex-1 sm:flex-none px-5 py-3
                           rounded-xl border border-gray-300
                           text-gray-700 text-center
                           font-semibold hover:bg-gray-50
                           transition"
                >
                    Clear
                </a>

            @endif

        </div>

    </div>

</form>


{{-- Clients --}}
@if ($clients->count())

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach ($clients as $client)

            <div
                class="bg-white border border-gray-200
                       rounded-2xl p-5 sm:p-6 shadow-sm
                       hover:shadow-xl hover:-translate-y-1
                       transition duration-300"
            >

                {{-- Profile --}}
                <div class="flex items-center gap-4">

                    @if ($client->profile_image)

                        <img
                            src="{{ asset(
                                'profiles/' . $client->profile_image
                            ) }}"
                            alt="{{ $client->name }}"
                            class="w-20 h-20 rounded-full
                                   object-cover border
                                   border-gray-200 flex-shrink-0"
                        >

                    @else

                        <div
                            class="w-20 h-20 rounded-full
                                   bg-indigo-100
                                   flex items-center
                                   justify-center
                                   text-2xl font-bold
                                   text-indigo-600
                                   flex-shrink-0"
                        >
                            {{ strtoupper(
                                substr(
                                    $client->name ?? 'U',
                                    0,
                                    1
                                )
                            ) }}
                        </div>

                    @endif


                    <div class="min-w-0">

                        <h2
                            class="text-lg font-bold text-gray-900
                                   truncate"
                        >
                            {{ $client->name }}
                        </h2>

                        <p class="text-sm text-gray-500">
                            Client
                        </p>

                    </div>

                </div>


                {{-- Bio --}}
                @if ($client->bio)

                    <p class="text-sm text-gray-600 mt-5 line-clamp-3">
                        {{ $client->bio }}
                    </p>

                @else

                    <p class="text-sm text-gray-400 mt-5">
                        No bio available.
                    </p>

                @endif


                {{-- Stats --}}
                <div
                    class="grid grid-cols-3 gap-3
                           mt-6 pt-5 border-t border-gray-200"
                >

                    <div>

                        <p class="text-lg font-bold text-gray-900">
                            {{ $client->collections_count }}
                        </p>

                        <p class="text-xs text-gray-500">
                            Collections
                        </p>

                    </div>


                    <div>

                        <p class="text-lg font-bold text-gray-900">
                            {{ $client->followers_count }}
                        </p>

                        <p class="text-xs text-gray-500">
                            Followers
                        </p>

                    </div>


                    <div>

                        <p class="text-lg font-bold text-gray-900">
                            {{ $client->following_count }}
                        </p>

                        <p class="text-xs text-gray-500">
                            Following
                        </p>

                    </div>

                </div>


                {{-- View Profile --}}
                <a
                    href="{{ route(
                        'client.profile',
                        $client->id
                    ) }}"
                    class="block w-full text-center
                           mt-5 rounded-xl
                           bg-indigo-600 text-white
                           py-3 font-semibold
                           hover:bg-indigo-700 transition"
                >
                    View Profile
                </a>

            </div>

        @endforeach

    </div>


    {{-- Pagination --}}
    <div class="mt-8">

        {{ $clients->links() }}

    </div>


@else

    {{-- Empty State --}}
    <div
        class="bg-white border border-gray-200
               rounded-2xl p-10 sm:p-16 text-center"
    >

        <div class="text-5xl sm:text-6xl mb-5">
            👤
        </div>

        <h2 class="text-xl font-bold text-gray-800">
            No clients found
        </h2>

        <p class="text-gray-500 mt-2">
            Try searching with another name.
        </p>

    </div>

@endif


</div>

@endsection
