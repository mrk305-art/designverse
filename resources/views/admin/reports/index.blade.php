@extends('layouts.admin')

@section('title', 'Manage Reports')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-gray-900">
            Manage Reports
        </h1>

        <p class="mt-2 text-gray-500">
            Review reports submitted against designs.
        </p>

    </div>


    {{-- Reports Table --}}
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
                            Reporter
                        </th>

                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                            Design
                        </th>

                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                            Designer
                        </th>

                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                            Reason
                        </th>

                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                            Status
                        </th>

                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                            Date
                        </th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">
    Action
</th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse ($reports as $report)

                        <tr class="hover:bg-gray-50 transition">

                            {{-- ID --}}
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $report->id }}
                            </td>


                            {{-- Reporter --}}
                            <td class="px-6 py-4">

                                @if ($report->user)

                                    <p class="font-semibold text-gray-900">
                                        {{ $report->user->name }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        {{ $report->user->email }}
                                    </p>

                                @else

                                    <span class="text-gray-400">
                                        Unknown
                                    </span>

                                @endif

                            </td>


                            {{-- Design --}}
                            <td class="px-6 py-4">

                                @if ($report->design)

                                    <p class="font-semibold text-gray-900">
                                        {{ $report->design->title }}
                                    </p>

                                @else

                                    <span class="text-gray-400">
                                        Deleted Design
                                    </span>

                                @endif

                            </td>


                            {{-- Designer --}}
                            <td class="px-6 py-4">

                                @if ($report->design && $report->design->user)

                                    <p class="text-sm text-gray-700">
                                        {{ $report->design->user->name }}
                                    </p>

                                @else

                                    <span class="text-gray-400">
                                        Unknown
                                    </span>

                                @endif

                            </td>


                            {{-- Reason --}}
                            <td class="px-6 py-4">

                                <span class="text-sm text-gray-700">
                                    {{ $report->reason }}
                                </span>

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-4">

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

                            </td>


                            {{-- Date --}}
                            <td class="px-6 py-4 text-sm text-gray-500">

                                {{ $report->created_at?->format('M d, Y') }}

                            </td>

                            <td class="px-6 py-4">

    <a
        href="{{ route('admin.reports.show', $report->id) }}"
        class="text-sm font-semibold
               text-indigo-600
               hover:text-indigo-800"
    >
        View
    </a>

</td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="px-6 py-12 text-center"
                            >

                                <p class="text-gray-500">
                                    No reports found.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection