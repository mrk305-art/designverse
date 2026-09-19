
@extends('layouts.designer')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">

        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                Notifications
            </h1>

            <p class="mt-2 text-gray-500">
                Stay updated with activity on your designs.
            </p>
        </div>

        {{-- Mark all as read --}}
        @if ($notifications->where('is_read', false)->count() > 0)

            <form
                action="{{ route('notifications.readAll') }}"
                method="POST"
            >
                @csrf

                <button
                    type="submit"
                    class="rounded-xl border border-gray-300
                           px-4 py-2.5 text-sm font-semibold
                           text-gray-700 hover:bg-gray-50 transition"
                >
                    Mark all as read
                </button>

            </form>

        @endif

    </div>


    {{-- Notifications --}}
    <div class="bg-white border border-gray-200
                rounded-2xl shadow-sm overflow-hidden">

        @forelse ($notifications as $notification)

            
<a
    href="{{ route(
        'notifications.redirect',
        $notification->id
    ) }}"
    class="flex items-center gap-4 p-5 border-b
           last:border-b-0 transition
           hover:bg-gray-50
           {{ !$notification->is_read
                ? 'bg-indigo-50'
                : 'bg-white'
           }}"
>

    {{-- Icon --}}
    <div
        class="w-12 h-12 shrink-0 rounded-full
               flex items-center justify-center text-xl
               {{ $notification->type === 'like'
                    ? 'bg-red-100'
                    : ($notification->type === 'follow'
                        ? 'bg-blue-100'
                        : ($notification->type === 'comment'
                            ? 'bg-green-100'
                            : 'bg-indigo-100'))
               }}"
    >

        @if ($notification->type === 'like')

            ❤️

        @elseif ($notification->type === 'follow')

            👥

        @elseif ($notification->type === 'comment')

            💬

        @elseif ($notification->type === 'save')

            🔖

        @else

            🔔

        @endif

    </div>


    {{-- Content --}}
    <div class="flex-1">

        <p class="text-gray-900 font-medium">
            {{ $notification->message }}
        </p>

        <p class="text-sm text-gray-500 mt-1">
            {{ $notification->created_at->diffForHumans() }}
        </p>

    </div>

</a>


{{-- Read Status / Button --}}

<div
    class="px-5 pb-4 -mt-2 text-right
           border-b last:border-b-0
           {{ !$notification->is_read
                ? 'bg-indigo-50'
                : 'bg-white'
           }}"
>

    @if (!$notification->is_read)

        <form
            action="{{ route(
                'notifications.read',
                $notification->id
            ) }}"
            method="POST"
            class="inline"
        >

            @csrf

            <button
                type="submit"
                class="text-sm font-semibold
                       text-indigo-600 hover:text-indigo-800"
            >
                Mark as read
            </button>

        </form>

    @else

        <span class="text-xs text-gray-400">
            Read
        </span>

    @endif

</div>



        @empty

            <div class="p-12 text-center">

                <div class="text-5xl mb-4">
                    🔔
                </div>

                <h3 class="text-lg font-semibold text-gray-800">
                    No notifications
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    You're all caught up!
                </p>

            </div>

        @endforelse

    </div>

</div>

@endsection

