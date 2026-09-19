@extends('layouts.admin')

@section('title', 'Manage Categories')

@section('content')

<div class="max-w-7xl mx-auto">


{{-- Header --}}
<div class="flex flex-col md:flex-row
            md:items-center md:justify-between
            gap-4 mb-8">

    <div>

        <h1 class="text-3xl font-bold text-gray-900">
            Manage Categories
        </h1>

        <p class="mt-2 text-gray-500">
            Create and manage design categories.
        </p>

    </div>


    {{-- Add Category --}}
    <a
        href="{{ route('admin.categories.create') }}"
        class="inline-flex items-center justify-center gap-2
               rounded-xl bg-indigo-600
               px-5 py-3
               font-semibold text-white
               hover:bg-indigo-700 transition"
    >
        + Add Category
    </a>

</div>


{{-- Search & Filters --}}
<div class="bg-white border border-gray-200
            rounded-2xl shadow-sm p-5 mb-6">

    <form
        action="{{ route('admin.categories.index') }}"
        method="GET"
        class="grid grid-cols-1 md:grid-cols-3 gap-4"
    >

        {{-- Search --}}
        <div class="md:col-span-2">

            <label
                for="search"
                class="block text-sm font-semibold
                       text-gray-700 mb-2"
            >
                Search Category
            </label>

            <input
                type="text"
                id="search"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by category name or slug..."
                class="w-full rounded-xl
                       border border-gray-300
                       px-4 py-3
                       focus:border-indigo-500
                       focus:ring-2 focus:ring-indigo-200
                       focus:outline-none transition"
            >

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
        <div class="md:col-span-3 flex items-center gap-3">

            <button
                type="submit"
                class="rounded-xl bg-indigo-600
                       px-6 py-3
                       font-semibold text-white
                       hover:bg-indigo-700 transition"
            >
                Search / Filter
            </button>


            @if (request()->hasAny(['search', 'status']))

                <a
                    href="{{ route('admin.categories.index') }}"
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
<div class="mb-4">

    <p class="text-sm text-gray-500">

        Showing

        <span class="font-semibold text-gray-700">
            {{ $categories->firstItem() ?? 0 }}
        </span>

        to

        <span class="font-semibold text-gray-700">
            {{ $categories->lastItem() ?? 0 }}
        </span>

        of

        <span class="font-semibold text-gray-700">
            {{ $categories->total() }}
        </span>

        categories

    </p>

</div>


{{-- Categories Table --}}
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
                        Category
                    </th>

                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                        Status
                    </th>

                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                        Designs
                    </th>

                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                        Created
                    </th>

                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                        Actions
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-gray-100">

                @forelse ($categories as $category)

                    <tr class="hover:bg-gray-50 transition">

                        {{-- ID --}}
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $category->id }}
                        </td>


                        {{-- Category --}}
                        <td class="px-6 py-4">

                            <div class="flex items-center gap-3">

                                {{-- Icon --}}
                                <div
                                    class="w-10 h-10 rounded-xl
                                           bg-indigo-50
                                           flex items-center justify-center
                                           text-lg"
                                >
                                    {{ $category->icon ?: '🎨' }}
                                </div>


                                <div>

                                    <p class="font-semibold text-gray-900">
                                        {{ $category->name }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        {{ $category->slug }}
                                    </p>

                                </div>

                            </div>

                        </td>


                        {{-- Status --}}
                        <td class="px-6 py-4">

                            @if ($category->status)

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


                        {{-- Designs Count --}}
                        <td class="px-6 py-4">

                            <span class="font-semibold text-gray-900">
                                {{ $category->designs_count }}
                            </span>

                        </td>


                        {{-- Created --}}
                        <td class="px-6 py-4 text-sm text-gray-500">

                            {{ $category->created_at?->format('M d, Y') }}

                        </td>


                        {{-- Actions --}}
                        <td class="px-6 py-4">

                            <div class="flex items-center gap-4">

                                {{-- Edit --}}
                                <a
                                    href="{{ route(
                                        'admin.categories.edit',
                                        $category->id
                                    ) }}"
                                    class="text-sm font-semibold
                                           text-indigo-600
                                           hover:text-indigo-800"
                                >
                                    Edit
                                </a>


                                {{-- Delete --}}
                                @if ($category->designs_count > 0)

                                    <span
                                        class="text-sm font-semibold
                                               text-gray-400 cursor-not-allowed"
                                        title="Cannot delete a category containing designs"
                                    >
                                        Delete
                                    </span>

                                @else

                                    <form
                                        action="{{ route(
                                            'admin.categories.destroy',
                                            $category->id
                                        ) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="text-sm font-semibold
                                                   text-red-600
                                                   hover:text-red-800"
                                            onclick="return confirm(
                                                'Are you sure you want to delete this category?'
                                            )"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                @endif

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="px-6 py-12 text-center"
                        >

                            <div class="text-4xl mb-3">
                                📁
                            </div>

                            <p class="font-semibold text-gray-700">
                                No categories found
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
@if ($categories->hasPages())

    <div class="mt-6">

        {{ $categories->links() }}

    </div>

@endif


</div>

@endsection
