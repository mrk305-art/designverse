@extends('layouts.admin')

@section('title', 'Report Details')

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- Back --}}
    <div class="mb-6">

        <a
            href="{{ route('admin.reports.index') }}"
            class="inline-flex items-center gap-2
                   text-sm font-semibold
                   text-gray-600
                   hover:text-indigo-600"
        >
            ← Back to Reports
        </a>

    </div>


    {{-- Header --}}
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-gray-900">
            Report Details
        </h1>

        <p class="mt-2 text-gray-500">
            Review the report submitted against this design.
        </p>

    </div>


    {{-- Report Information --}}
    <div class="bg-white border border-gray-200
                rounded-2xl shadow-sm p-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">


            {{-- Reporter --}}
            <div>

                <p class="text-sm text-gray-500">
                    Reported By
                </p>

                @if ($report->user)

                    <p class="mt-2 font-semibold text-gray-900">
                        {{ $report->user->name }}
                    </p>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ $report->user->email }}
                    </p>

                @else

                    <p class="mt-2 text-gray-400">
                        Unknown User
                    </p>

                @endif

            </div>


            {{-- Report Date --}}
            <div>

                <p class="text-sm text-gray-500">
                    Report Date
                </p>

                <p class="mt-2 font-semibold text-gray-900">
                    {{ $report->created_at?->format('M d, Y h:i A') }}
                </p>

            </div>


            {{-- Reason --}}
            <div>

                <p class="text-sm text-gray-500">
                    Reason
                </p>

                <p class="mt-2 font-semibold text-gray-900">
                    {{ $report->reason }}
                </p>

            </div>


            {{-- Status --}}
            <div>

                <p class="text-sm text-gray-500">
                    Status
                </p>

                <div class="mt-2">

                    @if ($report->status === 'pending')

                        <span
                            class="inline-flex rounded-full
                                   bg-yellow-100 px-3 py-1
                                   text-xs font-semibold
                                   text-yellow-700"
                        >
                            Pending
                        </span>

                    @elseif ($report->status === 'reviewed')

                        <span
                            class="inline-flex rounded-full
                                   bg-blue-100 px-3 py-1
                                   text-xs font-semibold
                                   text-blue-700"
                        >
                            Reviewed
                        </span>

                    @elseif ($report->status === 'resolved')

                        <span
                            class="inline-flex rounded-full
                                   bg-green-100 px-3 py-1
                                   text-xs font-semibold
                                   text-green-700"
                        >
                            Resolved
                        </span>

                    @else

                        <span
                            class="inline-flex rounded-full
                                   bg-red-100 px-3 py-1
                                   text-xs font-semibold
                                   text-red-700"
                        >
                            {{ ucfirst($report->status) }}
                        </span>

                    @endif

                </div>

            </div>

            {{-- Status Actions --}}
<div class="mt-8 pt-8 border-t border-gray-200">

    <p class="text-sm font-semibold text-gray-700 mb-3">
        Update Report Status
    </p>

    <form
        action="{{ route(
            'admin.reports.updateStatus',
            $report->id
        ) }}"
        method="POST"
        class="flex flex-wrap items-center gap-3"
    >

        @csrf

        <select
            name="status"
            class="rounded-xl border border-gray-300
                   px-4 py-2.5
                   focus:border-indigo-500
                   focus:ring-2 focus:ring-indigo-200
                   focus:outline-none"
        >

            <option
                value="pending"
                {{ $report->status === 'pending'
                    ? 'selected'
                    : '' }}
            >
                Pending
            </option>

            <option
                value="reviewed"
                {{ $report->status === 'reviewed'
                    ? 'selected'
                    : '' }}
            >
                Reviewed
            </option>

            <option
                value="resolved"
                {{ $report->status === 'resolved'
                    ? 'selected'
                    : '' }}
            >
                Resolved
            </option>

            <option
                value="rejected"
                {{ $report->status === 'rejected'
                    ? 'selected'
                    : '' }}
            >
                Rejected
            </option>

        </select>


        <button
            type="submit"
            class="rounded-xl bg-indigo-600
                   px-5 py-2.5
                   font-semibold text-white
                   hover:bg-indigo-700
                   transition"
        >
            Update Status
        </button>

    </form>

</div>

        </div>


        {{-- Description --}}
        <div class="mt-8 pt-8 border-t border-gray-200">

            <p class="text-sm text-gray-500">
                Description
            </p>

            @if ($report->description)

                <p class="mt-2 text-gray-700 leading-7">
                    {{ $report->description }}
                </p>

            @else

                <p class="mt-2 text-gray-400">
                    No additional description provided.
                </p>

            @endif

        </div>

    </div>


    {{-- Reported Design --}}
    <div class="bg-white border border-gray-200
                rounded-2xl shadow-sm p-8 mt-6">

        <h2 class="text-xl font-bold text-gray-900">
            Reported Design
        </h2>


        @if ($report->design)

            <div class="mt-6 flex flex-col md:flex-row gap-6">


                {{-- Image --}}
                <div>

                    @if ($report->design->images->count())

                        <img
                            src="{{ asset(
                                'designs/' .
                                $report->design->images->first()->image
                            ) }}"
                            alt="{{ $report->design->title }}"
                            class="w-64 h-48 rounded-xl
                                   object-cover border
                                   border-gray-200"
                        >

                    @else

                        <div
                            class="w-64 h-48 rounded-xl
                                   bg-gray-100
                                   flex items-center justify-center
                                   text-gray-400"
                        >
                            No Image
                        </div>

                    @endif

                </div>


                {{-- Design Information --}}
                <div class="flex-1">

                    <h3 class="text-2xl font-bold text-gray-900">
                        {{ $report->design->title }}
                    </h3>


                    @if ($report->design->category)

                        <span
                            class="inline-flex mt-3
                                   rounded-full
                                   bg-indigo-50
                                   px-3 py-1
                                   text-xs font-semibold
                                   text-indigo-600"
                        >
                            {{ $report->design->category->name }}
                        </span>

                    @endif


                    <p class="mt-4 text-gray-600">
                        {{ $report->design->description }}
                    </p>


                    {{-- Designer --}}
                    @if ($report->design->user)

                        <div class="mt-5">

                            <p class="text-sm text-gray-500">
                                Designer
                            </p>

                            <p class="font-semibold text-gray-900 mt-1">
                                {{ $report->design->user->name }}
                            </p>

                            <p class="text-sm text-gray-500">
                                {{ $report->design->user->email }}
                            </p>

                        </div>

                    @endif


                    {{-- View Design --}}
                    <div class="mt-5">

                        <a
                            href="{{ route(
                                'designs.show',
                                $report->design->id
                            ) }}"
                            class="inline-flex items-center
                                   rounded-xl
                                   bg-indigo-600
                                   px-5 py-3
                                   font-semibold text-white
                                   hover:bg-indigo-700
                                   transition"
                        >
                            View Design →
                        </a>

                    </div>

                </div>

            </div>

        @else

            <p class="mt-5 text-gray-500">
                This design is no longer available.
            </p>

        @endif

    </div>

</div>

@endsection