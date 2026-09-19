@extends('layouts.designer')

@section('content')




<div class="max-w-7xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">

        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                My Designs
            </h1>

            <p class="mt-2 text-gray-500">
                Manage your designs and publishing status.
            </p>
        </div>

        <a
            href="{{ route('designs.create') }}"
            class="inline-flex items-center rounded-xl
                   bg-indigo-600 px-5 py-3
                   font-semibold text-white
                   hover:bg-indigo-700 transition"
        >
            + Upload Design
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


    {{-- Designs --}}
    @if ($designs->count())

        <div class="grid grid-cols-3 gap-6">

            @foreach ($designs as $design)

                <div
                    class="bg-white border border-gray-200
                           rounded-2xl overflow-hidden
                           shadow-sm"
                >

                    {{-- Image --}}
                    <div class="aspect-[4/3] bg-gray-100">

                        @if ($design->images->first())

                            <img
                                src="{{ asset(
                                    'designs/' .
                                    $design->images->first()->image
                                ) }}"
                                alt="{{ $design->title }}"
                                class="w-full h-full object-cover"
                            >

                        @else

                            <div
                                class="w-full h-full flex items-center
                                       justify-center text-gray-400"
                            >
                                No Image
                            </div>

                        @endif

                    </div>


                    {{-- Content --}}
                    <div class="p-5">

                        <div class="flex items-start
                                    justify-between gap-3">

                            <div>

                                <h2 class="font-bold text-gray-900">
                                    {{ $design->title }}
                                </h2>

                                @if ($design->category)

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $design->category->name }}
                                    </p>

                                @endif

                            </div>


                            {{-- Status --}}
                            @if ($design->status === 'published')

                                <span
                                    class="shrink-0 rounded-full
                                           bg-green-100 text-green-700
                                           px-3 py-1 text-xs
                                           font-semibold"
                                >
                                    Published
                                </span>

                            @else

                                <span
                                    class="shrink-0 rounded-full
                                           bg-yellow-100 text-yellow-700
                                           px-3 py-1 text-xs
                                           font-semibold"
                                >
                                    Draft
                                </span>

                            @endif

                        </div>


                        {{-- Stats --}}
                        <div class="flex items-center gap-5 mt-4">

                            <span class="text-sm text-gray-500">
                                👁 {{ $design->views }}
                            </span>

                            <span class="text-sm text-gray-500">
                                ❤️ {{ $design->likes->count() }}
                            </span>

                            <span class="text-sm text-gray-500">
                                💬 {{ $design->comments->count() }}
                            </span>

                        </div>


                        {{-- Actions --}}
                        <div class="flex items-center gap-3 mt-5">

                            @if ($design->status === 'published')

                                <form
                                    action="{{ route(
                                        'designs.unpublish',
                                        $design->id
                                    ) }}"
                                    method="POST"
                                    class="flex-1"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="w-full rounded-xl
                                               border border-gray-300
                                               py-2.5 text-sm
                                               font-semibold text-gray-700
                                               hover:bg-gray-50 transition"
                                    >
                                        Unpublish
                                    </button>

                                </form>

                            @else

                                <form
                                    action="{{ route(
                                        'designs.publish',
                                        $design->id
                                    ) }}"
                                    method="POST"
                                    class="flex-1"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="w-full rounded-xl
                                               bg-indigo-600
                                               py-2.5 text-sm
                                               font-semibold text-white
                                               hover:bg-indigo-700 transition"
                                    >
                                        Publish
                                    </button>

                                </form>

                            @endif


                            <a
                                href="{{ route(
                                    'designs.show',
                                    $design->id
                                ) }}"
                                class="flex-1 text-center rounded-xl
                                       border border-gray-300
                                       py-2.5 text-sm font-semibold
                                       text-gray-700
                                       hover:bg-gray-50 transition"
                            >
                                View
                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>


        {{-- Pagination --}}
        <div class="mt-8">

            {{ $designs->links() }}

        </div>

    @else

        {{-- Empty State --}}
        <div
            class="bg-white border border-gray-200
                   rounded-2xl p-16 text-center"
        >

            <div class="text-6xl mb-5">
                🎨
            </div>

            <h2 class="text-xl font-bold text-gray-800">
                You haven't uploaded any designs yet
            </h2>

            <p class="text-gray-500 mt-2 mb-6">
                Upload your first design and share it
                with the community.
            </p>

            <a
                href="{{ route('designs.create') }}"
                class="inline-flex rounded-xl
                       bg-indigo-600 px-6 py-3
                       font-semibold text-white
                       hover:bg-indigo-700 transition"
            >
                + Upload Your First Design
            </a>

        </div>

    @endif

</div>





</div>

@endsection
