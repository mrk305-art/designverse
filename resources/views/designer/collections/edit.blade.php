@extends('layouts.designer')

@section('content')

<div class="max-w-3xl mx-auto">


{{-- Back --}}
<div class="mb-6">

    <a
        href="{{ route('collections.show', $collection->id) }}"
        class="inline-flex items-center gap-2
               text-sm font-semibold text-gray-600
               hover:text-indigo-600 transition"
    >
        ← Back to Collection
    </a>

</div>


{{-- Edit Collection --}}
<div
    class="bg-white border border-gray-200
           rounded-2xl shadow-sm p-8"
>

    <h1 class="text-2xl font-bold text-gray-900">
        Edit Collection
    </h1>

    <p class="text-gray-500 mt-2">
        Update your collection details.
    </p>


    <form
        action="{{ route(
            'collections.update',
            $collection->id
        ) }}"
        method="POST"
        class="mt-8"
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
                Collection Name
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old(
                    'name',
                    $collection->name
                ) }}"
                class="w-full rounded-xl
                       border border-gray-300
                       px-4 py-3
                       focus:border-indigo-500
                       focus:ring-2
                       focus:ring-indigo-500
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
                rows="5"
                class="w-full rounded-xl
                       border border-gray-300
                       px-4 py-3
                       focus:border-indigo-500
                       focus:ring-2
                       focus:ring-indigo-500
                       focus:outline-none"
            >{{ old(
                'description',
                $collection->description
            ) }}</textarea>

            @error('description')

                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- Buttons --}}
        <div class="flex items-center
                    justify-end gap-3 mt-8">

            <a
                href="{{ route(
                    'collections.show',
                    $collection->id
                ) }}"
                class="rounded-xl
                       border border-gray-300
                       px-5 py-3
                       text-sm font-semibold
                       text-gray-700
                       hover:bg-gray-50 transition"
            >
                Cancel
            </a>


            <button
                type="submit"
                class="rounded-xl
                       bg-indigo-600
                       px-6 py-3
                       text-sm font-semibold
                       text-white
                       hover:bg-indigo-700 transition"
            >
                Update Collection
            </button>

        </div>

    </form>

</div>


</div>

@endsection
