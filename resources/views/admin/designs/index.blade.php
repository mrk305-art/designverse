@extends('layouts.admin')

@section('title', 'Manage Designs')

@section('content')

<div class="max-w-7xl mx-auto">


{{-- Header --}}
<div class="mb-8">

    <h1 class="text-3xl font-bold text-gray-900">
        Manage Designs
    </h1>

    <p class="mt-2 text-gray-500">
        View and manage all designs uploaded to DesignVerse.
    </p>

</div>


{{-- Search & Filters --}}
<div class="bg-white border border-gray-200
            rounded-2xl shadow-sm p-5 mb-6">

    <form
        action="{{ route('admin.designs.index') }}"
        method="GET"
        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4"
    >

        {{-- Search --}}
        <div class="lg:col-span-2">

            <label
                for="search"
                class="block text-sm font-semibold
                       text-gray-700 mb-2"
            >
                Search Design
            </label>

            <input
                type="text"
                id="search"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by design title..."
                class="w-full rounded-xl
                       border border-gray-300
                       px-4 py-3
                       focus:border-indigo-500
                       focus:ring-2 focus:ring-indigo-200
                       focus:outline-none transition"
            >

        </div>


        {{-- Designer --}}
        <div>

            <label
                for="designer"
                class="block text-sm font-semibold
                       text-gray-700 mb-2"
            >
                Designer
            </label>

            <select
                id="designer"
                name="designer"
                class="w-full rounded-xl
                       border border-gray-300
                       px-4 py-3
                       focus:border-indigo-500
                       focus:ring-2 focus:ring-indigo-200
                       focus:outline-none transition"
            >

                <option value="">
                    All Designers
                </option>

                @foreach ($designers as $designer)

                    <option
                        value="{{ $designer->id }}"
                        {{ request('designer') == $designer->id
                            ? 'selected'
                            : '' }}
                    >
                        {{ $designer->name }}
                    </option>

                @endforeach

            </select>

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
                class="w-full rounded-xl
                       border border-gray-300
                       px-4 py-3
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
                            : '' }}
                    >
                        {{ $category->name }}
                    </option>

                @endforeach

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
                    value="published"
                    {{ request('status') === 'published'
                        ? 'selected'
                        : '' }}
                >
                    Published
                </option>

                <option
                    value="draft"
                    {{ request('status') === 'draft'
                        ? 'selected'
                        : '' }}
                >
                    Draft
                </option>

            </select>

        </div>


        {{-- Visibility --}}
        <div>

            <label
                for="visibility"
                class="block text-sm font-semibold
                       text-gray-700 mb-2"
            >
                Visibility
            </label>

            <select
                id="visibility"
                name="visibility"
                class="w-full rounded-xl
                       border border-gray-300
                       px-4 py-3
                       focus:border-indigo-500
                       focus:ring-2 focus:ring-indigo-200
                       focus:outline-none transition"
            >

                <option value="">
                    All Visibility
                </option>

                <option
                    value="public"
                    {{ request('visibility') === 'public'
                        ? 'selected'
                        : '' }}
                >
                    Public
                </option>

                <option
                    value="private"
                    {{ request('visibility') === 'private'
                        ? 'selected'
                        : '' }}
                >
                    Private
                </option>

            </select>

        </div>


        {{-- Buttons --}}
        <div class="lg:col-span-2 flex items-end gap-3">

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


            @if (request()->hasAny([
                'search',
                'designer',
                'category',
                'status',
                'visibility'
            ]))

                <a
                    href="{{ route('admin.designs.index') }}"
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
            {{ $designs->firstItem() ?? 0 }}
        </span>

        to

        <span class="font-semibold text-gray-700">
            {{ $designs->lastItem() ?? 0 }}
        </span>

        of

        <span class="font-semibold text-gray-700">
            {{ $designs->total() }}
        </span>

        designs

    </p>

</div>


{{-- Designs Table --}}
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
                        Design
                    </th>

                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                        Designer
                    </th>

                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                        Category
                    </th>

                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                        Status
                    </th>

                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                        Uploaded
                    </th>

                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                        Action
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-gray-100">

                @forelse ($designs as $design)

                    <tr class="hover:bg-gray-50 transition">

                        {{-- ID --}}
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $design->id }}
                        </td>


                        {{-- Design --}}
                        <td class="px-6 py-4">

                            <div class="flex items-center gap-4">

                                @if ($design->images->count())

                                    <img
                                        src="{{ asset(
                                            'designs/' .
                                            $design->images->first()->image
                                        ) }}"
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


                                <div>

                                    <p class="font-semibold text-gray-900">
                                        {{ $design->title }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        {{ $design->visibility === 'public'
                                            ? 'Public'
                                            : 'Private'
                                        }}
                                    </p>

                                </div>

                            </div>

                        </td>


                        {{-- Designer --}}
                        <td class="px-6 py-4">

                            @if ($design->user)

                                <p class="font-medium text-gray-900">
                                    {{ $design->user->name }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    {{ $design->user->email }}
                                </p>

                            @else

                                <span class="text-gray-400">
                                    Unknown
                                </span>

                            @endif

                        </td>


                        {{-- Category --}}
                        <td class="px-6 py-4">

                            @if ($design->category)

                                <span
                                    class="inline-flex rounded-full
                                           bg-indigo-50 px-3 py-1
                                           text-xs font-semibold
                                           text-indigo-600"
                                >
                                    {{ $design->category->name }}
                                </span>

                            @else

                                <span class="text-gray-400">
                                    No Category
                                </span>

                            @endif

                        </td>


                        {{-- Status --}}
                        <td class="px-6 py-4">

                            @if ($design->status === 'published')

                                <span
                                    class="inline-flex rounded-full
                                           bg-green-100 px-3 py-1
                                           text-xs font-semibold
                                           text-green-700"
                                >
                                    Published
                                </span>

                            @else

                                <span
                                    class="inline-flex rounded-full
                                           bg-yellow-100 px-3 py-1
                                           text-xs font-semibold
                                           text-yellow-700"
                                >
                                    Draft
                                </span>

                            @endif

                        </td>


                        {{-- Uploaded --}}
                        <td class="px-6 py-4 text-sm text-gray-500">

                            {{ $design->created_at?->format('M d, Y') }}

                        </td>


                        {{-- Action --}}
                        <td class="px-6 py-4">

                            <div class="flex items-center gap-3">

                                <a
                                    href="{{ route(
                                        'designs.show',
                                        $design->id
                                    ) }}"
                                    class="text-sm font-semibold
                                           text-indigo-600
                                           hover:text-indigo-800"
                                >
                                    View
                                </a>


                                <form
                                    action="{{ route(
                                        'admin.designs.toggleStatus',
                                        $design->id
                                    ) }}"
                                    method="POST"
                                >

                                    @csrf

                                    @if ($design->status === 'published')

                                        <button
                                            type="submit"
                                            class="text-sm font-semibold
                                                   text-red-600
                                                   hover:text-red-800"
                                            onclick="return confirm(
                                                'Are you sure you want to unpublish this design?'
                                            )"
                                        >
                                            Unpublish
                                        </button>

                                    @else

                                        <button
                                            type="submit"
                                            class="text-sm font-semibold
                                                   text-green-600
                                                   hover:text-green-800"
                                        >
                                            Publish
                                        </button>

                                    @endif

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            class="px-6 py-12 text-center"
                        >

                            <div class="text-4xl mb-3">
                                🎨
                            </div>

                            <p class="font-semibold text-gray-700">
                                No designs found
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
@if ($designs->hasPages())

    <div class="mt-6">

        {{ $designs->links() }}

    </div>

@endif


</div>

@endsection
