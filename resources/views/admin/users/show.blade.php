@extends('layouts.admin')

@section('title', 'User Details')

@section('content')

<div class="max-w-6xl mx-auto">


{{-- Back --}}
<div class="mb-6">

    <a
        href="{{ route('admin.users.index') }}"
        class="inline-flex items-center gap-2
               text-sm font-semibold
               text-gray-600 hover:text-indigo-600"
    >
        ← Back to Users
    </a>

</div>


{{-- Profile Header --}}
<div class="bg-white border border-gray-200
            rounded-2xl shadow-sm p-8">

    <div class="flex flex-col md:flex-row
                md:items-center md:justify-between gap-6">

        <div class="flex items-center gap-5">

            {{-- Avatar --}}
            <div
                class="w-20 h-20 rounded-full
                       bg-indigo-100
                       flex items-center justify-center
                       text-indigo-600 text-3xl font-bold"
            >
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>


            {{-- Name --}}
            <div>

                <h1 class="text-2xl font-bold text-gray-900">
                    {{ $user->name }}
                </h1>

                @if ($user->username)

                    <p class="text-gray-500 mt-1">
                        {{ $user->username }}
                    </p>

                @endif

                <div class="mt-3">

                    <span
                        class="inline-flex rounded-full
                               px-3 py-1 text-xs font-semibold
                               {{ $user->role === 'admin'
                                    ? 'bg-purple-100 text-purple-700'
                                    : ($user->role === 'designer'
                                        ? 'bg-indigo-100 text-indigo-700'
                                        : 'bg-gray-100 text-gray-700')
                               }}"
                    >
                        {{ ucfirst($user->role) }}
                    </span>

                </div>

            </div>

        </div>


        {{-- Status --}}
        <div>

            @if ($user->status)

                <span
                    class="inline-flex rounded-full
                           bg-green-100 px-4 py-2
                           text-sm font-semibold
                           text-green-700"
                >
                    ● Active
                </span>

            @else

                <span
                    class="inline-flex rounded-full
                           bg-red-100 px-4 py-2
                           text-sm font-semibold
                           text-red-700"
                >
                    ● Inactive
                </span>

            @endif

            <div class="mt-4">


<form
    action="{{ route('admin.users.toggleStatus', $user->id) }}"
    method="POST"
>

    @csrf

    @if ($user->status)

        <button
            type="submit"
            class="rounded-xl bg-red-50
                   px-4 py-2.5 text-sm font-semibold
                   text-red-600
                   hover:bg-red-100 transition"
            onclick="return confirm('Are you sure you want to deactivate this user?')"
        >
            Deactivate User
        </button>

    @else

        <button
            type="submit"
            class="rounded-xl bg-green-50
                   px-4 py-2.5 text-sm font-semibold
                   text-green-600
                   hover:bg-green-100 transition"
        >
            Activate User
        </button>

    @endif

</form>


</div>


        </div>

        

    </div>

</div>


{{-- Statistics --}}
<div class="grid grid-cols-1 sm:grid-cols-2
            lg:grid-cols-4 gap-5 mt-6">

    {{-- Designs --}}
    <div class="bg-white border border-gray-200
                rounded-2xl shadow-sm p-6">

        <p class="text-sm font-semibold text-gray-500">
            Designs
        </p>

        <p class="mt-2 text-3xl font-bold text-gray-900">
            {{ $user->designs->count() }}
        </p>

    </div>


    {{-- Likes --}}
    <div class="bg-white border border-gray-200
                rounded-2xl shadow-sm p-6">

        <p class="text-sm font-semibold text-gray-500">
            Likes
        </p>

        <p class="mt-2 text-3xl font-bold text-gray-900">
            {{ $user->designLikes->count() }}
        </p>

    </div>


    {{-- Comments --}}
    <div class="bg-white border border-gray-200
                rounded-2xl shadow-sm p-6">

        <p class="text-sm font-semibold text-gray-500">
            Comments
        </p>

        <p class="mt-2 text-3xl font-bold text-gray-900">
            {{ $user->designComments->count() }}
        </p>

    </div>


    {{-- Followers --}}
    <div class="bg-white border border-gray-200
                rounded-2xl shadow-sm p-6">

        <p class="text-sm font-semibold text-gray-500">
            Followers
        </p>

        <p class="mt-2 text-3xl font-bold text-gray-900">
            {{ $user->followers->count() }}
        </p>

    </div>

</div>


{{-- Account Information --}}
<div class="bg-white border border-gray-200
            rounded-2xl shadow-sm p-6 mt-6">

    <h2 class="text-xl font-bold text-gray-900">
        Account Information
    </h2>


    <div class="mt-5 grid grid-cols-1
                md:grid-cols-2 gap-5">

        {{-- Email --}}
        <div>

            <p class="text-sm text-gray-500">
                Email
            </p>

            <p class="mt-1 font-semibold text-gray-900">
                {{ $user->email }}
            </p>

        </div>


        {{-- Verification --}}
        <div>

            <p class="text-sm text-gray-500">
                Email Verification
            </p>

            @if ($user->is_verified)

                <p class="mt-1 font-semibold text-green-600">
                    Verified
                </p>

            @else

                <p class="mt-1 font-semibold text-red-600">
                    Not Verified
                </p>

            @endif

        </div>


        {{-- Joined --}}
        <div>

            <p class="text-sm text-gray-500">
                Joined
            </p>

            <p class="mt-1 font-semibold text-gray-900">
                {{ $user->created_at?->format('M d, Y') }}
            </p>

        </div>


        {{-- User ID --}}
        <div>

            <p class="text-sm text-gray-500">
                User ID
            </p>

            <p class="mt-1 font-semibold text-gray-900">
                #{{ $user->id }}
            </p>

        </div>

    </div>

</div>


{{-- User Designs --}}
@if ($user->designs->count())

    <div class="bg-white border border-gray-200
                rounded-2xl shadow-sm p-6 mt-6">

        <h2 class="text-xl font-bold text-gray-900">
            User Designs
        </h2>

        <div class="mt-5 space-y-3">

            @foreach ($user->designs as $design)

                <div
                    class="flex items-center justify-between
                           border border-gray-100
                           rounded-xl p-4"
                >

                    <div>

                        <p class="font-semibold text-gray-900">
                            {{ $design->title }}
                        </p>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ ucfirst($design->status) }}
                        </p>

                    </div>


                    <a
                        href="{{ route('designs.show', $design->id) }}"
                        class="text-sm font-semibold
                               text-indigo-600
                               hover:text-indigo-800"
                    >
                        View Design →
                    </a>

                </div>

            @endforeach

        </div>

    </div>

@endif


</div>

@endsection
