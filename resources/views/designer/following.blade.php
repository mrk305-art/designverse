
@extends('layouts.frontend')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- Back --}}
    <div class="mb-6">

        <a
            href="{{ route('designer.profile', $designer->id) }}"
            class="inline-flex items-center gap-2
                   text-sm font-semibold text-gray-600
                   hover:text-indigo-600 transition"
        >
            ← Back to Profile
        </a>

    </div>


    {{-- Header --}}
    <div class="bg-white border border-gray-200
                rounded-2xl shadow-sm p-6 mb-6">

        <h1 class="text-2xl font-bold text-gray-900">
            {{ $designer->name }} is Following
        </h1>

        <p class="text-gray-500 mt-1">
            Designers followed by {{ $designer->name }}.
        </p>

    </div>


    {{-- Following --}}
    @if ($following->count())

        <div class="bg-white border border-gray-200
                    rounded-2xl shadow-sm overflow-hidden">

            @foreach ($following as $follow)

                @php
                    $user = $follow->following;
                @endphp

                @if ($user)

                    <div
                        class="flex items-center justify-between
                               p-5 border-b border-gray-100
                               last:border-b-0"
                    >

                        {{-- User --}}
                       
<a
    href="{{ $user->role === 'designer'
        ? route('designer.profile', $user->id)
        : route('client.profile', $user->id)
    }}"
    class="flex items-center gap-4"
>



                            {{-- Avatar --}}
                            @if ($user->profile_image)

                                <img
                                    src="{{ asset(
                                        'profiles/' .
                                        $user->profile_image
                                    ) }}"
                                    alt="{{ $user->name }}"
                                    class="w-12 h-12 rounded-full
                                           object-cover border
                                           border-gray-200"
                                >

                            @else

                                <div
                                    class="w-12 h-12 rounded-full
                                           bg-indigo-100
                                           flex items-center
                                           justify-center
                                           text-indigo-600
                                           font-bold"
                                >
                                    {{ strtoupper(
                                        substr(
                                            $user->name ?? 'U',
                                            0,
                                            1
                                        )
                                    ) }}
                                </div>

                            @endif


                          
{{-- Name --}}
<div>

    @if ($user->role === 'designer')

        <a
            href="{{ route('designer.profile', $user->id) }}"
            class="font-semibold text-gray-900
                   hover:text-indigo-600"
        >
            {{ $user->name }}
        </a>

    @else

        <span class="font-semibold text-gray-900">
            {{ $user->name }}
        </span>

    @endif

    <p class="text-sm text-gray-500">
        {{ ucfirst($user->role) }}
    </p>

</div>




                        {{-- Follow Button --}}
                        @if (auth()->check() && auth()->id() !== $user->id)

                            @php
                                $isFollowingUser = auth()->user()
                                    ->following()
                                    ->where(
                                        'following_id',
                                        $user->id
                                    )
                                    ->exists();
                            @endphp

                            <form
                                action="{{ route(
                                    'users.follow',
                                    $user->id
                                ) }}"
                                method="POST"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="rounded-xl px-4 py-2
                                           text-sm font-semibold
                                           transition
                                           {{ $isFollowingUser
                                                ? 'bg-gray-200 text-gray-800 hover:bg-gray-300'
                                                : 'bg-indigo-600 text-white hover:bg-indigo-700'
                                           }}"
                                >
                                    {{ $isFollowingUser
                                        ? 'Following'
                                        : '+ Follow'
                                    }}
                                </button>

                            </form>

                        @endif

                    </div>

                @endif

            @endforeach

        </div>


        {{-- Pagination --}}
        <div class="mt-6">
            {{ $following->links() }}
        </div>

    @else

        {{-- Empty --}}
        <div
            class="bg-white border border-gray-200
                   rounded-2xl p-12 text-center"
        >

            <div class="text-5xl mb-4">
                👥
            </div>

            <h2 class="text-xl font-bold text-gray-900">
                Not Following Anyone
            </h2>

            <p class="text-gray-500 mt-2">
                {{ $designer->name }} isn't following any designers yet.
            </p>

        </div>

    @endif

</div>

@endsection

