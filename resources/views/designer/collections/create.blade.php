@extends('layouts.designer')

@section('content')

<div class="max-w-3xl mx-auto">


<div class="mb-8">

    <h1 class="text-3xl font-bold text-gray-900">
        Create Collection
    </h1>

    <p class="mt-2 text-gray-500">
        Organize your favorite designs into a collection.
    </p>

</div>


<div class="bg-white border border-gray-200
            rounded-2xl shadow-sm p-8">

    <form
        action="{{ route('collections.store') }}"
        method="POST"
    >

        @csrf

        @if($designId)

            <input
                type="hidden"
                name="design_id"
                value="{{ $designId }}"
            >

        @endif


        {{-- Collection Name --}}
        <div>

            <label
                for="name"
                class="block text-sm font-semibold
                       text-gray-700 mb-2"
            >
                Collection Name
            </label>

            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                placeholder="e.g. UI Inspiration"
                class="w-full rounded-xl border
                       border-gray-300 px-4 py-3
                       focus:border-indigo-500
                       focus:ring-2 focus:ring-indigo-200
                       focus:outline-none"
                required
            >

            @error('name')

                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- Description --}}
        <div class="mt-6">

            <label
                for="description"
                class="block text-sm font-semibold
                       text-gray-700 mb-2"
            >
                Description
            </label>

            <textarea
                id="description"
                name="description"
                rows="4"
                placeholder="What is this collection about?"
                class="w-full rounded-xl border
                       border-gray-300 px-4 py-3
                       focus:border-indigo-500
                       focus:ring-2 focus:ring-indigo-200
                       focus:outline-none resize-none"
            >{{ old('description') }}</textarea>

            @error('description')

                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- Actions --}}
        <div class="flex items-center
                    justify-end gap-3 mt-8">

            <a
                href="{{ route('collections.index') }}"
                class="rounded-xl border border-gray-300
                       px-5 py-3 font-semibold
                       text-gray-700
                       hover:bg-gray-50 transition"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="rounded-xl bg-indigo-600
                       px-6 py-3 font-semibold text-white
                       hover:bg-indigo-700 transition"
            >
                Create Collection
            </button>

        </div>

    </form>

</div>


</div>

@endsection
