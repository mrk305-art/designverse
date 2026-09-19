@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')

<div class="max-w-7xl mx-auto">


{{-- Header --}}
<div class="mb-8">

    <h1 class="text-3xl font-bold text-gray-900">
        Admin Dashboard
    </h1>

    <p class="mt-2 text-gray-500">
        Manage and monitor your DesignVerse platform.
    </p>

</div>


{{-- Statistics --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

    {{-- Users --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">

        <p class="text-sm font-semibold text-gray-500">
            Total Users
        </p>

        <p class="mt-2 text-3xl font-bold text-gray-900">
            {{ $totalUsers }}
        </p>

        

    </div>


    {{-- Designers --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">

        <p class="text-sm font-semibold text-gray-500">
            Total Designers
        </p>

        <p class="mt-2 text-3xl font-bold text-gray-900">
            {{ $totalDesigners }}
        </p>

    </div>


    {{-- Clients --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">

        <p class="text-sm font-semibold text-gray-500">
            Total Clients
        </p>

        <p class="mt-2 text-3xl font-bold text-gray-900">
            {{ $totalClients }}
        </p>

    </div>


    {{-- Designs --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">

        <p class="text-sm font-semibold text-gray-500">
            Total Designs
        </p>

        <p class="mt-2 text-3xl font-bold text-gray-900">
            {{ $totalDesigns }}
        </p>

    </div>


    {{-- Likes --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">

        <p class="text-sm font-semibold text-gray-500">
            Total Likes
        </p>

        <p class="mt-2 text-3xl font-bold text-gray-900">
            {{ $totalLikes }}
        </p>

    </div>


    {{-- Comments --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">

        <p class="text-sm font-semibold text-gray-500">
            Total Comments
        </p>

        <p class="mt-2 text-3xl font-bold text-gray-900">
            {{ $totalComments }}
        </p>

    </div>

    
{{-- Published Designs --}}
<div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">

    <p class="text-sm font-semibold text-gray-500">
        Published Designs
    </p>

    <p class="mt-2 text-3xl font-bold text-green-600">
        {{ $publishedDesigns }}
    </p>

</div>


{{-- Draft Designs --}}
<div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">

    <p class="text-sm font-semibold text-gray-500">
        Draft Designs
    </p>

    <p class="mt-2 text-3xl font-bold text-yellow-600">
        {{ $draftDesigns }}
    </p>

</div>


{{-- Total Categories --}}
<div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">

    <p class="text-sm font-semibold text-gray-500">
        Total Categories
    </p>

    <p class="mt-2 text-3xl font-bold text-gray-900">
        {{ $totalCategories }}
    </p>

</div>


{{-- Active Users --}}
<div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">

    <p class="text-sm font-semibold text-gray-500">
        Active Users
    </p>

    <p class="mt-2 text-3xl font-bold text-indigo-600">
        {{ $activeUsers }}
    </p>

</div>


{{-- Pending Reports --}}
<div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">

    <p class="text-sm font-semibold text-gray-500">
        Pending Reports
    </p>

    <p class="mt-2 text-3xl font-bold text-red-600">
        {{ $pendingReports }}
    </p>

</div>



</div>

{{-- Recent Activity --}}

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">


{{-- Recent Users --}}
<div class="bg-white border border-gray-200
            rounded-2xl shadow-sm overflow-hidden">

    <div class="p-6 border-b border-gray-200">

        <h2 class="text-xl font-bold text-gray-900">
            Recent Users
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Latest registered users
        </p>

    </div>


    <div class="divide-y divide-gray-100">

        @forelse ($recentUsers as $user)

            <div class="flex items-center justify-between p-5">

                <div class="flex items-center gap-3">

                    <div
                        class="w-10 h-10 rounded-full
                               bg-indigo-100
                               flex items-center justify-center
                               text-indigo-600 font-bold"
                    >
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <div>

                        <p class="font-semibold text-gray-900">
                            {{ $user->name }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $user->role }}
                        </p>

                    </div>

                </div>


                <span class="text-xs text-gray-400">
                    {{ $user->created_at?->diffForHumans() }}
                </span>

            </div>

        @empty

            <div class="p-6 text-center text-gray-500">
                No users found.
            </div>

        @endforelse

    </div>

</div>



{{-- Recent Designs --}}
<div class="bg-white border border-gray-200
            rounded-2xl shadow-sm overflow-hidden">

    <div class="p-6 border-b border-gray-200">

        <h2 class="text-xl font-bold text-gray-900">
            Recent Designs
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Latest uploaded designs
        </p>

    </div>


    <div class="divide-y divide-gray-100">

        @forelse ($recentDesigns as $design)

            <div class="flex items-center gap-4 p-5">

                @if ($design->images->count())

                    <img
                        src="{{ asset('designs/' . $design->images->first()->image) }}"
                        alt="{{ $design->title }}"
                        class="w-16 h-12 rounded-lg
                               object-cover border
                               border-gray-200"
                    >

                @else

                    <div
                        class="w-16 h-12 rounded-lg
                               bg-gray-100
                               flex items-center
                               justify-center
                               text-xs text-gray-400"
                    >
                        No Image
                    </div>

                @endif


                <div class="flex-1 min-w-0">

                    <p class="font-semibold text-gray-900 truncate">
                        {{ $design->title }}
                    </p>

                    <p class="text-sm text-gray-500">
                        {{ $design->user->name ?? 'Unknown Designer' }}
                    </p>

                </div>


                @if ($design->status === 'published')

                    <span
                        class="shrink-0 rounded-full
                               bg-green-100 px-3 py-1
                               text-xs font-semibold
                               text-green-700"
                    >
                        Published
                    </span>

                @else

                    <span
                        class="shrink-0 rounded-full
                               bg-yellow-100 px-3 py-1
                               text-xs font-semibold
                               text-yellow-700"
                    >
                        Draft
                    </span>

                @endif

            </div>

        @empty

            <div class="p-6 text-center text-gray-500">
                No designs found.
            </div>

        @endforelse

    </div>
    

</div>


</div>

{{-- Recent Activities --}}
<div class="bg-white border border-gray-200
            rounded-2xl shadow-sm overflow-hidden mt-6">

    {{-- Header --}}
    <div class="p-6 border-b border-gray-200">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-xl font-bold text-gray-900">
                    Recent Activities
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Latest activity across your platform
                </p>

            </div>

            @if ($recentActivities->count())

                <span
                    class="rounded-full
                           bg-indigo-50
                           px-3 py-1
                           text-xs font-semibold
                           text-indigo-600"
                >
                    {{ $recentActivities->count() }} Activities
                </span>

            @endif

        </div>

        

    </div>


    {{-- Activities --}}
    <div class="divide-y divide-gray-100">

        @forelse ($recentActivities as $activity)

            <div class="flex items-center gap-4 p-5">

                {{-- Activity Icon --}}
                <div
                    class="w-11 h-11 rounded-full
                           flex items-center justify-center
                           shrink-0
                           {{ $activity->type === 'user_registered'
                                ? 'bg-indigo-100 text-indigo-600'
                                : 'bg-purple-100 text-purple-600'
                           }}"
                >

                    @if ($activity->type === 'user_registered')

                        👤

                    @elseif ($activity->type === 'design_uploaded')

                        🎨

                    @else

                        🔔

                    @endif

                </div>


                {{-- Activity Content --}}
                <div class="flex-1 min-w-0">

                    <p class="font-medium text-gray-900">
                        {{ $activity->message }}
                    </p>

                    <p class="text-sm text-gray-400 mt-1">
                        {{ $activity->created_at?->diffForHumans() }}
                    </p>

                </div>


                {{-- Status --}}
                @if (!$activity->is_read)

                    <span
                        class="shrink-0
                               w-2.5 h-2.5
                               rounded-full
                               bg-indigo-600"
                        title="Unread"
                    ></span>

                @else

                    <span
                        class="text-xs text-gray-400"
                    >
                        Read
                    </span>

                @endif

            </div>

        @empty

            <div class="p-10 text-center">

                <div class="text-4xl mb-3">
                    🔔
                </div>

                <p class="font-semibold text-gray-700">
                    No recent activities
                </p>

                <p class="text-sm text-gray-400 mt-1">
                    New user registrations and design uploads
                    will appear here.
                </p>

            </div>

        @endforelse

    </div>

</div>



</div>

@endsection
