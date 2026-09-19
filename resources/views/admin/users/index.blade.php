@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')

<div class="max-w-7xl mx-auto">


{{-- Header --}}
<div class="mb-8">

    <h1 class="text-3xl font-bold text-gray-900">
        Manage Users
    </h1>

    <p class="mt-2 text-gray-500">
        View and manage all registered users.
    </p>

</div>


{{-- Search & Filters --}}
<div class="bg-white border border-gray-200
            rounded-2xl shadow-sm p-5 mb-6">

    <form
        action="{{ route('admin.users.index') }}"
        method="GET"
        class="grid grid-cols-1 md:grid-cols-4 gap-4"
    >

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
                type="text"
                id="search"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search name, username or email..."
                class="w-full rounded-xl
                       border border-gray-300
                       px-4 py-3
                       focus:border-indigo-500
                       focus:ring-2 focus:ring-indigo-200
                       focus:outline-none transition"
            >

        </div>


        {{-- Role --}}
        <div>

            <label
                for="role"
                class="block text-sm font-semibold
                       text-gray-700 mb-2"
            >
                Role
            </label>

            <select
                id="role"
                name="role"
                class="w-full rounded-xl
                       border border-gray-300
                       px-4 py-3
                       focus:border-indigo-500
                       focus:ring-2 focus:ring-indigo-200
                       focus:outline-none transition"
            >

                <option value="">
                    All Roles
                </option>

                <option
                    value="admin"
                    {{ request('role') === 'admin' ? 'selected' : '' }}
                >
                    Admin
                </option>

                <option
                    value="designer"
                    {{ request('role') === 'designer' ? 'selected' : '' }}
                >
                    Designer
                </option>

                <option
                    value="client"
                    {{ request('role') === 'client' ? 'selected' : '' }}
                >
                    Client
                </option>

            </select>

        </div>


        {{-- Status --}}
        <div>

            <label
                for="status"
                class="block text-sm font-semibold
                       text-gray-700 mb-2"
            >
                Status
            </label>

            <select
                id="status"
                name="status"
                class="w-full rounded-xl
                       border border-gray-300
                       px-4 py-3
                       focus:border-indigo-500
                       focus:ring-2 focus:ring-indigo-200
                       focus:outline-none transition"
            >

                <option value="">
                    All Status
                </option>

                <option
                    value="1"
                    {{ request('status') === '1' ? 'selected' : '' }}
                >
                    Active
                </option>

                <option
                    value="0"
                    {{ request('status') === '0' ? 'selected' : '' }}
                >
                    Inactive
                </option>

            </select>

        </div>


        {{-- Buttons --}}
        <div class="md:col-span-4 flex items-center gap-3 pt-1">

            <button
                type="submit"
                class="rounded-xl bg-indigo-600
                       px-6 py-3
                       font-semibold text-white
                       hover:bg-indigo-700
                       transition"
            >
                Search / Filter
            </button>


            @if (request()->hasAny(['search', 'role', 'status']))

                <a
                    href="{{ route('admin.users.index') }}"
                    class="rounded-xl border border-gray-300
                           px-6 py-3
                           font-semibold text-gray-700
                           hover:bg-gray-50 transition"
                >
                    Clear
                </a>

            @endif

        </div>

    </form>

</div>


{{-- Results Information --}}
<div class="flex items-center justify-between mb-4">

    <p class="text-sm text-gray-500">

        Showing
        <span class="font-semibold text-gray-700">
            {{ $users->firstItem() ?? 0 }}
        </span>

        to

        <span class="font-semibold text-gray-700">
            {{ $users->lastItem() ?? 0 }}
        </span>

        of

        <span class="font-semibold text-gray-700">
            {{ $users->total() }}
        </span>

        users

    </p>

</div>


{{-- Users Table --}}
<div class="bg-white border border-gray-200
            rounded-2xl shadow-sm overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full text-left">

            <thead class="bg-gray-50 border-b border-gray-200">

                <tr>

                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                        #
                    </th>

                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                        User
                    </th>

                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                        Email
                    </th>

                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                        Role
                    </th>

                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                        Status
                    </th>

                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                        Joined
                    </th>

                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                        Action
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-gray-100">

                @forelse ($users as $user)

                    <tr class="hover:bg-gray-50 transition">

                        {{-- ID --}}
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $user->id }}
                        </td>


                        {{-- User --}}
                        <td class="px-6 py-4">

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

                                    @if ($user->username)

                                        <p class="text-sm text-gray-500">
                                            {{ $user->username }}
                                        </p>

                                    @endif

                                </div>

                            </div>

                        </td>


                        {{-- Email --}}
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $user->email }}
                        </td>


                        {{-- Role --}}
                        <td class="px-6 py-4">

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

                        </td>


                        {{-- Status --}}
                        <td class="px-6 py-4">

                            @if ($user->status)

                                <span
                                    class="inline-flex rounded-full
                                           bg-green-100 px-3 py-1
                                           text-xs font-semibold
                                           text-green-700"
                                >
                                    Active
                                </span>

                            @else

                                <span
                                    class="inline-flex rounded-full
                                           bg-red-100 px-3 py-1
                                           text-xs font-semibold
                                           text-red-700"
                                >
                                    Inactive
                                </span>

                            @endif

                        </td>


                        {{-- Joined --}}
                        <td class="px-6 py-4 text-sm text-gray-500">

                            {{ $user->created_at?->format('M d, Y') }}

                        </td>


                        {{-- Action --}}
                        <td class="px-6 py-4">

                            <a
                                href="{{ route('admin.users.show', $user->id) }}"
                                class="text-sm font-semibold
                                       text-indigo-600
                                       hover:text-indigo-800"
                            >
                                View
                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            class="px-6 py-12 text-center"
                        >

                            <div class="text-4xl mb-3">
                                👤
                            </div>

                            <p class="font-semibold text-gray-700">
                                No users found
                            </p>

                            <p class="text-sm text-gray-500 mt-1">
                                Try changing your search or filters.
                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- Pagination --}}
@if ($users->hasPages())

    <div class="mt-6">

        {{ $users->links() }}

    </div>

@endif


</div>

@endsection
