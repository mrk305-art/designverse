
@extends('layouts.client')

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">

        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                My Collections
            </h1>

            <p class="mt-2 text-gray-500">
                Organize your favorite designs into collections.
            </p>
        </div>

        <a
            href="{{ route('collections.create') }}"
            class="inline-flex items-center gap-2
                   rounded-xl bg-indigo-600
                   px-5 py-3 font-semibold text-white
                   hover:bg-indigo-700 transition"
        >
            + New Collection
        </a>

    </div>


    {{-- Success Message --}}
    @if (session('success'))

        <div
            class="mb-6 rounded-xl border border-green-200
                   bg-green-50 px-5 py-4
                   text-green-700 font-medium"
        >
            {{ session('success') }}
        </div>

    @endif


    {{-- Collections --}}
    @if ($collections->count())

        <div class="grid grid-cols-1 md:grid-cols-2
                    lg:grid-cols-3 gap-6">

            @foreach ($collections as $collection)

                <div
                    class="bg-white border border-gray-200
                           rounded-2xl overflow-hidden
                           shadow-sm hover:shadow-lg
                           transition"
                >

                    {{-- Collection Preview --}}
                    <div
                        class="h-44 bg-gray-100
                               flex items-center justify-center"
                    >

                        <div class="text-5xl">
                            📁
                        </div>

                    </div>


                    {{-- Collection Info --}}
                    <div class="p-5">

                        <h2 class="text-xl font-bold text-gray-900">
                            {{ $collection->name }}
                        </h2>

                        @if ($collection->description)

                            <p class="text-sm text-gray-500 mt-2 line-clamp-2">
                                {{ $collection->description }}
                            </p>

                        @endif


                        <div
                            class="flex items-center justify-between
                                   mt-5"
                        >

                            <span class="text-sm text-gray-500">
                                🎨 {{ $collection->designs_count }}
                                {{ $collection->designs_count == 1
                                    ? 'Design'
                                    : 'Designs' }}
                            </span>


                           <a
    href="{{ route('collections.show', $collection->id) }}"
    class="text-sm font-semibold
           text-indigo-600
           hover:text-indigo-800"
>
    View Collection →
</a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        {{-- Empty State --}}
        <div
            class="bg-white border border-gray-200
                   rounded-2xl p-12 text-center"
        >

            <div class="text-6xl mb-5">
                📁
            </div>

            <h2 class="text-xl font-bold text-gray-900">
                No collections yet
            </h2>

            <p class="text-gray-500 mt-2">
                Create your first collection to organize
                your favorite designs.
            </p>

            <a
                href="{{ route('collections.create') }}"
                class="inline-flex items-center gap-2
                       mt-6 rounded-xl bg-indigo-600
                       px-5 py-3 font-semibold text-white
                       hover:bg-indigo-700 transition"
            >
                + Create Collection
            </a>

        </div>

    @endif

</div>

@endsection

