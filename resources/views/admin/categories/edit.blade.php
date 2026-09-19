@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')

<div class="max-w-3xl mx-auto">


{{-- Header --}}
<div class="mb-8">

    <h1 class="text-3xl font-bold text-gray-900">
        Edit Category
    </h1>

    <p class="mt-2 text-gray-500">
        Update the category information.
    </p>

</div>


{{-- Form --}}
<div class="bg-white border border-gray-200
            rounded-2xl shadow-sm p-8">

    <form
        action="{{ route('admin.categories.update', $category->id) }}"
        method="POST"
        class="space-y-6"
    >

        @csrf
        @method('PUT')


        {{-- Name --}}
        <div>

            <label
                for="name"
                class="block text-sm font-semibold
                       text-gray-700 mb-2"
            >
                Category Name
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $category->name) }}"
                class="w-full rounded-xl
                       border border-gray-300
                       px-4 py-3
                       focus:border-indigo-500
                       focus:ring-2
                       focus:ring-indigo-200
                       focus:outline-none"
            >

            @error('name')

                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- Slug --}}
        <div>

            <label
                for="slug"
                class="block text-sm font-semibold
                       text-gray-700 mb-2"
            >
                Slug
            </label>

            <input
                type="text"
                id="slug"
                name="slug"
                value="{{ old('slug', $category->slug) }}"
                class="w-full rounded-xl
                       border border-gray-300
                       px-4 py-3
                       focus:border-indigo-500
                       focus:ring-2
                       focus:ring-indigo-200
                       focus:outline-none"
            >

            @error('slug')

                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- Icon --}}
        <div>

            <label
                for="icon"
                class="block text-sm font-semibold
                       text-gray-700 mb-2"
            >
                Icon
            </label>

            <input
                type="text"
                id="icon"
                name="icon"
                value="{{ old('icon', $category->icon) }}"
                class="w-full rounded-xl
                       border border-gray-300
                       px-4 py-3
                       focus:border-indigo-500
                       focus:ring-2
                       focus:ring-indigo-200
                       focus:outline-none"
            >

            @error('icon')

                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

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
                       focus:ring-2
                       focus:ring-indigo-200
                       focus:outline-none"
            >

                <option
                    value="1"
                    {{ old('status', $category->status) == 1
                        ? 'selected'
                        : '' }}
                >
                    Active
                </option>

                <option
                    value="0"
                    {{ old('status', $category->status) == 0
                        ? 'selected'
                        : '' }}
                >
                    Inactive
                </option>

            </select>

            @error('status')

                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>

{{-- Buttons --}}
<div class="flex items-center justify-end gap-3 pt-4">

    <a
        href="{{ route('admin.categories.index') }}"
        class="rounded-xl border border-gray-300
               px-5 py-3
               font-semibold text-gray-700
               hover:bg-gray-50 transition"
    >
        Cancel
    </a>

    <button
        type="submit"
        class="rounded-xl bg-indigo-600
               px-5 py-3
               font-semibold text-white
               hover:bg-indigo-700 transition"
    >
        Update Category
    </button>

</div>
    </form>

</div>


</div>

@endsection
