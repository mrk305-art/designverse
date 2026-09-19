@extends('layouts.designer')

@section('content')

<div class="space-y-8">

    <!-- Stats -->

    
<div class="grid grid-cols-4 gap-6">

    @include('designer.components.stats-card', [
        'title' => 'Designs',
        'value' => $designCount,
        'growth' => null,
        'icon' => '🎨'
    ])

    @include('designer.components.stats-card', [
        'title' => 'Views',
        'value' => number_format($viewsCount),
        'growth' => null,
        'icon' => '👁'
    ])

    @include('designer.components.stats-card', [
        'title' => 'Followers',
        'value' => $followersCount,
        'growth' => null,
        'icon' => '👥'
    ])

    @include('designer.components.stats-card', [
        'title' => 'Likes',
        'value' => number_format($likesCount),
        'growth' => null,
        'icon' => '❤️'
    ])





    </div>

    <!-- Second Row -->

    <div class="grid grid-cols-2 gap-6">

        <!-- Quick Actions -->

        <div class="bg-white rounded-2xl border p-6">

            <h3 class="font-bold text-xl mb-5">

                Quick Actions

            </h3>

            <div class="space-y-3">

                <a
    href="{{ route('designs.create') }}"
    class="block w-full text-center rounded-xl bg-indigo-600 text-white py-3 hover:bg-indigo-700 transition"
>
    + Upload Design
</a>

               <a
    href="{{ route('designer.profile.edit') }}"
    class="block w-full text-center rounded-xl
           border py-3 hover:bg-gray-100 transition"
>
    Edit Profile
</a>

                <a
    href="{{ route('designer.profile', auth()->id()) }}"
    class="block w-full text-center rounded-xl border py-3
           hover:bg-gray-100 transition"
>
    View Portfolio
</a>

            </div>

        </div>

        <!-- Recent Activity -->

        <div class="bg-white rounded-2xl border p-6">

            <h3 class="font-bold text-xl mb-5">

                Recent Activity

            </h3>

            <div class="space-y-5">

                <div>
                    <p class="font-semibold">Ahmed liked your design</p>
                    <span class="text-sm text-gray-500">2 min ago</span>
                </div>

                <div>
                    <p class="font-semibold">Sara started following you</p>
                    <span class="text-sm text-gray-500">10 min ago</span>
                </div>

                <div>
                    <p class="font-semibold">Ali commented on your design</p>
                    <span class="text-sm text-gray-500">1 hour ago</span>
                </div>

            </div>

        </div>

    </div>


{{-- My Designs --}}
<div class="bg-white rounded-2xl border p-6">

    <div class="flex items-center justify-between mb-6">

        <div>

            <h3 class="font-bold text-xl">
                My Designs
            </h3>

            <p class="text-sm text-gray-500 mt-1">
                Your latest uploaded designs
            </p>

        </div>

        <a
            href="{{ route('designs.create') }}"
            class="rounded-xl bg-indigo-600 px-4 py-2
                   text-sm font-semibold text-white
                   hover:bg-indigo-700 transition"
        >
            + Upload Design
        </a>

    </div>


    @if ($designs->count())

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach ($designs as $design)

                <div
                    class="group overflow-hidden rounded-2xl
                           border border-gray-200 bg-white
                           hover:shadow-lg transition"
                >

                    {{-- Design Image --}}
                    <div class="relative bg-gray-100">

                        @if ($design->images->count())

                            <img
                                src="{{ asset('designs/' . $design->images->first()->image) }}"
                                alt="{{ $design->title }}"
                                class="w-full h-52 object-cover
                                       group-hover:scale-105 transition duration-300"
                            >

                        @else

                            <div
                                class="w-full h-52 flex items-center
                                       justify-center text-gray-400"
                            >
                                No Image
                            </div>

                        @endif

                    </div>


                    {{-- Design Info --}}
                    <div class="p-5">

                        <div class="flex items-start justify-between gap-3">

                            <div>

                                <h4 class="font-bold text-lg text-gray-900">
                                    {{ $design->title }}
                                </h4>

                                @if ($design->category)

                                    <p class="text-sm text-indigo-600 mt-1">
                                        {{ $design->category->name }}
                                    </p>

                                @endif

                            </div>


                            {{-- Status --}}
                            <span
                                class="shrink-0 rounded-full
                                       bg-gray-100 px-3 py-1
                                       text-xs font-semibold text-gray-600"
                            >
                                {{ ucfirst($design->status) }}
                            </span>

                        </div>


                        {{-- Date --}}
                        <p class="text-sm text-gray-500 mt-3">

                            {{ $design->created_at->format('M d, Y') }}

                        </p>


                        {{-- View Button --}}
                        <a
                            href="{{ route('designs.show', $design->id) }}"
                            class="block mt-4 w-full rounded-xl
                                   bg-gray-900 px-4 py-3
                                   text-center text-sm font-semibold
                                   text-white hover:bg-gray-800 transition"
                        >
                            View Design
                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        {{-- Empty State --}}
        <div
            class="rounded-2xl border-2 border-dashed
                   border-gray-200 p-12 text-center"
        >

            <div class="text-5xl mb-4">
                🎨
            </div>

            <h4 class="text-lg font-bold text-gray-900">
                No designs yet
            </h4>

            <p class="text-sm text-gray-500 mt-2">
                Upload your first design and share it with the community.
            </p>

            <a
                href="{{ route('designs.create') }}"
                class="inline-flex mt-5 rounded-xl
                       bg-indigo-600 px-5 py-3
                       text-sm font-semibold text-white
                       hover:bg-indigo-700 transition"
            >
                Upload Your First Design
            </a>

        </div>

    @endif

</div>


</div>



@endsection