@extends('layouts.client')

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- Back --}}
    <div class="mb-6">

        <a
            href="{{ route('collections.index') }}"
            class="inline-flex items-center gap-2
                   text-sm font-semibold text-gray-600
                   hover:text-indigo-600 transition"
        >
            ← Back to Collections
        </a>

    </div>


   {{-- Collection Header Card --}}

<div
    class="bg-white border border-gray-200
           rounded-2xl shadow-sm p-8 mb-8"
>


{{-- Collection Name + Actions --}}
<div class="flex flex-col sm:flex-row
            sm:items-center sm:justify-between
            gap-5">

    {{-- Collection Name --}}
    <div>

        <h1 class="text-3xl font-bold text-gray-900">
            {{ $collection->name }}
        </h1>

    </div>


    {{-- Actions --}}
    <div class="flex items-center gap-3 shrink-0">

        {{-- Edit Collection --}}
        <a
            href="{{ route('collections.edit', $collection->id) }}"
            class="inline-flex items-center gap-2
                   rounded-xl bg-gray-100
                   px-4 py-2.5
                   text-sm font-semibold
                   text-gray-700
                   hover:bg-gray-200 transition"
        >
            ✏️ Edit Collection
        </a>


        {{-- Delete Collection --}}
        <form
            action="{{ route('collections.destroy', $collection->id) }}"
            method="POST"
            onsubmit="return confirm('Are you sure you want to delete this collection?');"
        >

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="inline-flex items-center gap-2
                       rounded-xl bg-red-50
                       px-4 py-2.5
                       text-sm font-semibold
                       text-red-600
                       hover:bg-red-100
                       transition"
            >
                🗑️ Delete
            </button>

        </form>

    </div>

</div>


{{-- Description --}}
@if ($collection->description)

    <p class="mt-4 text-gray-500 max-w-2xl leading-6">
        {{ $collection->description }}
    </p>

@endif


{{-- Divider --}}
<div class="border-t border-gray-100 my-5"></div>


{{-- Design Count --}}
<div class="flex items-center gap-2 text-sm text-gray-500">

    <span class="text-base">
        🎨
    </span>

    <span>
        {{ $collection->designs->count() }}

        {{ $collection->designs->count() == 1
            ? 'Design'
            : 'Designs' }}
    </span>

</div>


</div>

    

    


    {{-- Designs --}}
    @if ($collection->designs->count())

        <div
            class="grid grid-cols-1 md:grid-cols-2
                   lg:grid-cols-3 gap-6"
        >

            @foreach ($collection->designs as $design)

                <div
                    class="bg-white border border-gray-200
                           rounded-2xl overflow-hidden
                           shadow-sm hover:shadow-lg transition"
                >

                    {{-- Image --}}
                    <a
                        href="{{ route('designs.show', $design->id) }}"
                    >

                        <div
                            class="aspect-[4/3]
                                   bg-gray-100 overflow-hidden"
                        >

                            @if ($design->images->count())

                                <img
                                    src="{{ asset(
                                        'designs/' .
                                        $design->images->first()->image
                                    ) }}"
                                    alt="{{ $design->title }}"
                                    class="w-full h-full object-cover
                                           hover:scale-105
                                           transition duration-300"
                                >

                            @else

                                <div
                                    class="w-full h-full
                                           flex items-center
                                           justify-center
                                           text-gray-400"
                                >
                                    No image
                                </div>

                            @endif

                        </div>

                    </a>


                    {{-- Info --}}
                    <div class="p-5">

                        <h2 class="font-bold text-gray-900">
                            {{ $design->title }}
                        </h2>

                        @if ($design->category)

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $design->category->name }}
                            </p>

                        @endif


                        <div class="flex items-center gap-4 mt-4">

                            <span class="text-sm text-gray-500">
                                👁 {{ $design->views }}
                            </span>

                            <span class="text-sm text-gray-500">
                                ❤️ {{ $design->likes->count() }}
                            </span>

                        </div>

                        <form
    action="{{ route(
        'collections.removeDesign',
        [
            'collectionId' => $collection->id,
            'designId' => $design->id
        ]
    ) }}"
    method="POST"
    class="mt-5"
>
    @csrf
    @method('DELETE')

    <button
        type="submit"
        class="w-full rounded-xl
               border border-red-200
               bg-red-50
               px-4 py-2.5
               text-sm font-semibold
               text-red-600
               hover:bg-red-100
               transition"
        onclick="return confirm('Remove this design from the collection?')"
    >
        🗑 Remove from Collection
    </button>

</form>

                    </div>

                </div>

            @endforeach

            

        </div>

    @else

        <div
            class="bg-white border border-gray-200
                   rounded-2xl p-12 text-center"
        >

            <div class="text-5xl mb-4">
                📁
            </div>

            <h2 class="text-xl font-bold text-gray-900">
                This collection is empty
            </h2>

            <p class="text-gray-500 mt-2">
                Save some designs to this collection.
            </p>

        </div>

    @endif

</div>

@endsection