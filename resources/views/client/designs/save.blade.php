@extends('layouts.client')

@section('content')

<div class="max-w-3xl mx-auto">

    {{-- Back --}}
    <div class="mb-3 flex justify-between ">

    

        <a
            href="{{ route('designs.show', $design->id) }}"
            class="text-sm font-semibold text-gray-600
                   hover:text-indigo-600 transition"
        >
            ← Back to Design
        </a>

          <a
    href="{{ route('collections.create', ['design_id' => $design->id]) }}"
    class="rounded-xl border border-gray-300
           px-6 py-3 font-semibold
           text-gray-700
           hover:bg-gray-50 transition"
>
    + Create Collection
</a>

    </div>


    <div
        class="bg-white border border-gray-200
               rounded-2xl shadow-sm p-8"
    >

        <h1 class="text-2xl font-bold text-gray-900">
            Save Design
        </h1>

        <p class="text-gray-500 mt-2">
            Choose a collection for
            <strong>{{ $design->title }}</strong>
        </p>


        @if ($collections->count())

            <form
                action="{{ route(
                    'designs.saveToCollection',
                    $design->id
                ) }}"
                method="POST"
                class="mt-8"
            >

                @csrf


                <div class="space-y-3">

                    @foreach ($collections as $collection)


                    @php
    $isSaved = $collection->designs()
        ->where('design_id', $design->id)
        ->exists();
@endphp

                        <label
                            class="flex items-center gap-4
                                   border border-gray-200
                                   rounded-xl p-4
                                   cursor-pointer
                                   hover:bg-gray-50
                                   transition"
                        >

                            <input
                                type="radio"
                                name="collection_id"
                                value="{{ $collection->id }}"
                                class="w-5 h-5 text-indigo-600"
                            >

                            <div class="flex-1">

                                <p class="font-semibold text-gray-900">
                                    {{ $collection->name }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    {{ $collection->designs_count ?? $collection->designs()->count() }}
                                    Designs
                                </p>

                            </div>

                          @if ($isSaved)
    <span class="text-sm font-semibold text-green-600">
        ✓ Saved
    </span>
@else
    <span class="text-2xl">
        📁
    </span>
@endif

                        </label>

                    @endforeach

                </div>


                @error('collection_id')

                    <p class="mt-3 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

    


                <div class="flex justify-end mt-8">

     

                    <button
                        type="submit"
                        class="rounded-xl bg-indigo-600
                               px-6 py-3 font-semibold
                               text-white
                               hover:bg-indigo-700 transition"
                    >
                        Save to Collection
                    </button>

                </div>

                

            </form>

        @else

            <div
                class="mt-8 rounded-xl
                       border-2 border-dashed
                       border-gray-200 p-8 text-center"
            >

                <div class="text-5xl mb-4">
                    📁
                </div>

                <h2 class="font-bold text-gray-900">
                    No collections yet
                </h2>

                <p class="text-gray-500 mt-2">
                    Create a collection first.
                </p>

                <a
    href="{{ route('collections.create', ['design_id' => $design->id]) }}"
    class="inline-flex mt-5
           rounded-xl bg-indigo-600
           px-5 py-3
           font-semibold text-white
           hover:bg-indigo-700 transition"
>
    + Create Collection
</a>

            </div>

        @endif

    </div>

</div>

@endsection