
@extends('layouts.frontend')

@section('title', $design->title . ' - DesignVerse')

@section('content')

{{-- Success Message --}}
@if (session('success'))

    <div class="max-w-6xl mx-auto px-6 pt-6">

        <div
            class="mb-6 rounded-xl
                   bg-green-50 border border-green-200
                   px-5 py-4
                   text-sm font-semibold
                   text-green-700"
        >
            {{ session('success') }}
        </div>

    </div>

@endif


{{-- Error Message --}}
@if (session('error'))

    <div class="max-w-6xl mx-auto px-6 pt-6">

        <div
            class="mb-6 rounded-xl
                   bg-red-50 border border-red-200
                   px-5 py-4
                   text-sm font-semibold
                   text-red-700"
        >
            {{ session('error') }}
        </div>

    </div>

@endif


<div class="max-w-6xl mx-auto px-6 py-10">

    {{-- Back Button --}}
    <div class="mb-6">

        <a
            href="{{ route('explore') }}"
            class="inline-flex items-center gap-2 text-sm font-semibold
                   text-gray-600 hover:text-indigo-600 transition"
        >
            ← Back to Explore
        </a>

    </div>


    {{-- Main Card --}}
    <div
        class="bg-white border border-gray-200
               rounded-2xl shadow-sm overflow-hidden"
    >

        <div class="grid grid-cols-1 lg:grid-cols-2">


            {{-- Images Section --}}
            <div class="p-6 bg-gray-50">

                @if ($design->images->count())

                    {{-- Main Image --}}
                    <div
                        class="bg-white rounded-2xl
                               overflow-hidden border border-gray-200"
                    >

                        <img
                            id="main-design-image"
                            src="{{ asset('designs/' . $design->images->first()->image) }}"
                            alt="{{ $design->title }}"
                            class="w-full h-[500px] object-contain"
                        >

                    </div>


                    {{-- Thumbnails --}}
                    <div class="grid grid-cols-4 gap-3 mt-4">

                        @foreach ($design->images as $image)

                            <button
                                type="button"
                                onclick="changeMainImage('{{ asset('designs/' . $image->image) }}', this)"
                                class="image-thumbnail rounded-xl overflow-hidden
                                       border-2 border-transparent
                                       hover:border-indigo-500 transition
                                       bg-white"
                            >

                                <img
                                    src="{{ asset('designs/' . $image->image) }}"
                                    alt="{{ $design->title }}"
                                    class="w-full h-24 object-cover"
                                >

                            </button>

                        @endforeach

                    </div>

                @else

                    <div
                        class="h-[500px] flex items-center justify-center
                               rounded-2xl bg-gray-100 text-gray-400"
                    >
                        No image available
                    </div>

                @endif

            </div>


            {{-- Design Information --}}
            <div class="p-8 lg:p-10">

                {{-- Category --}}
                @if ($design->category)

                    <a
                        href="{{ route('explore', ['category' => $design->category->id]) }}"
                        class="inline-flex items-center rounded-full
                               bg-indigo-50 px-3 py-1 text-sm
                               font-semibold text-indigo-600
                               hover:bg-indigo-100 transition"
                    >
                        {{ $design->category->name }}
                    </a>

                @endif


                {{-- Title --}}
                <h1 class="mt-5 text-4xl font-bold text-gray-900">
                    {{ $design->title }}
                </h1>


                {{-- Description --}}
                <div class="mt-6">

                    <h2 class="text-lg font-semibold text-gray-900">
                        About this design
                    </h2>

                    <p class="mt-3 text-gray-600 leading-7">
                        {{ $design->description }}
                    </p>

                </div>


                {{-- Designer --}}
                <div class="mt-8 pt-6 border-t border-gray-200">

                    <h2
                        class="text-sm font-semibold text-gray-500
                               uppercase tracking-wide"
                    >
                        Designer
                    </h2>


                    <div class="mt-3 flex items-center gap-3">

                        {{-- Designer Profile Link --}}
                        <a
                            href="{{ route('designer.profile', $design->user->id) }}"
                            class="flex items-center gap-3 group"
                        >

                            {{-- Avatar --}}
                            <div
                                class="w-11 h-11 rounded-full bg-indigo-100
                                       flex items-center justify-center
                                       text-indigo-600 font-bold
                                       group-hover:bg-indigo-200 transition"
                            >
                                {{ strtoupper(substr($design->user->name ?? 'U', 0, 1)) }}
                            </div>


                            {{-- Name --}}
                            <div>

                                <p
                                    class="font-semibold text-gray-900
                                           group-hover:text-indigo-600 transition"
                                >
                                    {{ $design->user->name ?? 'Unknown Designer' }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    Design Creator
                                </p>

                            </div>

                        </a>

                    </div>


                    {{-- Follow --}}
                    <div class="mt-4 flex items-center gap-3">

                        @auth

                            <form
                                action="{{ route('users.follow', $design->user->id) }}"
                                method="POST"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="rounded-xl px-5 py-2.5 font-semibold
                                           transition
                                           {{ $userFollowed
                                                ? 'bg-gray-200 text-gray-800 hover:bg-gray-300'
                                                : 'bg-indigo-600 text-white hover:bg-indigo-700'
                                           }}"
                                >
                                    {{ $userFollowed ? 'Following' : '+ Follow' }}
                                </button>

                            </form>

                        @else

                            <a
                                href="{{ route('login') }}"
                                class="rounded-xl px-5 py-2.5
                                       bg-indigo-600 text-white
                                       font-semibold
                                       hover:bg-indigo-700 transition"
                            >
                                + Follow
                            </a>

                        @endauth


                        <span class="text-sm text-gray-500">
                            {{ $design->user->followers_count }} Followers
                        </span>

                    </div>

                </div>


                {{-- Design Status --}}
                <div class="mt-8">

                    <div class="flex items-center justify-between">

                        <span class="text-sm text-gray-500">
                            Status
                        </span>

                        <span
                            class="inline-flex rounded-full
                                   bg-gray-100 px-3 py-1
                                   text-sm font-semibold text-gray-700"
                        >
                            {{ ucfirst($design->status) }}
                        </span>

                    </div>

                </div>


                {{-- Date --}}
                <div class="mt-4">

                    <div class="flex items-center justify-between">

                        <span class="text-sm text-gray-500">
                            Uploaded
                        </span>

                        <span class="text-sm font-medium text-gray-700">
                            {{ $design->created_at->format('M d, Y') }}
                        </span>

                    </div>

                </div>


                {{-- Actions --}}
                <div class="mt-8 flex flex-wrap gap-3">


                    {{-- LIKE --}}
                    @auth

                        <form
                            action="{{ route('designs.like', $design->id) }}"
                            method="POST"
                            class="flex-1 min-w-[140px]"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="w-full rounded-xl px-5 py-3
                                       font-semibold transition
                                       {{ $userLiked
                                            ? 'bg-red-500 text-white hover:bg-red-600'
                                            : 'bg-indigo-600 text-white hover:bg-indigo-700'
                                       }}"
                            >
                                {{ $userLiked ? '❤️ Liked' : '❤️ Like' }}
                            </button>

                            <p class="text-center text-sm text-gray-500 mt-2">
                                ❤️ {{ $design->likes_count }} Likes
                            </p>

                        </form>

                    @else

                        <div class="flex-1 min-w-[140px]">

                            <a
                                href="{{ route('login') }}"
                                class="block w-full text-center
                                       rounded-xl px-5 py-3
                                       bg-indigo-600 text-white
                                       font-semibold
                                       hover:bg-indigo-700 transition"
                            >
                                ❤️ Like
                            </a>

                            <p class="text-center text-sm text-gray-500 mt-2">
                                ❤️ {{ $design->likes_count }} Likes
                            </p>

                        </div>

                    @endauth


                    {{-- SAVE --}}
                    @auth

                        @php
                            $isSaved = $design->saves()
                                ->where('user_id', auth()->id())
                                ->exists();
                        @endphp


                        @if ($isSaved)

                            <form
                                action="{{ route('designs.unsave', $design->id) }}"
                                method="POST"
                                class="inline"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="inline-flex items-center gap-2
                                           rounded-xl bg-indigo-100
                                           px-5 py-3 text-indigo-700
                                           font-semibold hover:bg-indigo-200
                                           transition"
                                >
                                    🔖 Saved
                                </button>

                            </form>

                        @else

                           <form
    action="{{ route('designs.saveDirect', $design->id) }}"
    method="POST"
>
    @csrf

    <button
        type="submit"
        class="inline-flex items-center gap-2
               rounded-xl border border-gray-300
               px-5 py-3 text-gray-700
               font-semibold hover:bg-gray-50
               transition"
    >
        🔖 Save
    </button>
</form>

                        @endif

                    @else

                        <a
                            href="{{ route('login') }}"
                            class="inline-flex items-center gap-2
                                   rounded-xl border border-gray-300
                                   px-5 py-3 text-gray-700
                                   font-semibold hover:bg-gray-50
                                   transition"
                        >
                            🔖 Save
                        </a>

                    @endauth


                    {{-- Share --}}
                    <button
                        type="button"
                        onclick="shareDesign()"
                        class="flex-1 min-w-[120px]
                               rounded-xl border border-gray-300
                               px-5 py-3
                               font-semibold text-gray-700
                               hover:bg-gray-50 transition"
                    >
                        📤 Share
                    </button>


                    {{-- Copy Link --}}
                    <button
                        type="button"
                        onclick="copyDesignLink()"
                        class="flex-1 min-w-[120px]
                               rounded-xl border border-gray-300
                               px-5 py-3
                               font-semibold text-gray-700
                               hover:bg-gray-50 transition"
                    >
                        🔗 Copy Link
                    </button>


                    {{-- Comment Button --}}
                    <button
                        type="button"
                        onclick="document.getElementById('comments-section').scrollIntoView({ behavior: 'smooth' })"
                        class="flex-1 min-w-[120px]
                               rounded-xl border border-gray-300
                               px-5 py-3
                               font-semibold text-gray-700
                               hover:bg-gray-50 transition"
                    >
                        💬 Comment
                    </button>

                </div>


                {{-- Share / Copy JavaScript --}}
                <script>

                    function shareDesign() {

                        const url = window.location.href;

                        if (navigator.share) {

                            navigator.share({
                                title: @json($design->title),
                                text: 'Check out this design!',
                                url: url
                            });

                        } else {

                            copyDesignLink();

                        }

                    }


                    function copyDesignLink() {

                        const url = window.location.href;

                        navigator.clipboard.writeText(url)
                            .then(function () {

                                alert('Design link copied!');

                            })
                            .catch(function () {

                                alert('Unable to copy link.');

                            });

                    }

                </script>


                {{-- Report Design --}}
                <div class="mt-6 pt-6 border-t border-gray-200">

                    @auth

                        <details>

                            <summary
                                class="cursor-pointer
                                       text-sm font-semibold
                                       text-gray-500
                                       hover:text-red-600
                                       transition"
                            >
                                🚩 Report this design
                            </summary>


                            <form
                                action="{{ route('designs.report', $design->id) }}"
                                method="POST"
                                class="mt-4 space-y-4"
                            >

                                @csrf


                                {{-- Reason --}}
                                <div>

                                    <label
                                        for="reason"
                                        class="block text-sm font-semibold
                                               text-gray-700 mb-2"
                                    >
                                        Reason
                                    </label>

                                    <select
                                        id="reason"
                                        name="reason"
                                        required
                                        class="w-full rounded-xl
                                               border border-gray-300
                                               px-4 py-3
                                               focus:border-red-500
                                               focus:ring-2
                                               focus:ring-red-100
                                               focus:outline-none"
                                    >

                                        <option value="">
                                            Select a reason
                                        </option>

                                        <option value="Inappropriate content">
                                            Inappropriate content
                                        </option>

                                        <option value="Copyright violation">
                                            Copyright violation
                                        </option>

                                        <option value="Spam">
                                            Spam
                                        </option>

                                        <option value="Harassment">
                                            Harassment
                                        </option>

                                        <option value="Misleading content">
                                            Misleading content
                                        </option>

                                        <option value="Other">
                                            Other
                                        </option>

                                    </select>

                                    @error('reason')

                                        <p class="mt-2 text-sm text-red-600">
                                            {{ $message }}
                                        </p>

                                    @enderror

                                </div>


                                {{-- Description --}}
                                <div>

                                    <label
                                        for="description"
                                        class="block text-sm font-semibold
                                               text-gray-700 mb-2"
                                    >
                                        Additional details
                                        <span class="font-normal text-gray-400">
                                            (optional)
                                        </span>
                                    </label>

                                    <textarea
                                        id="description"
                                        name="description"
                                        rows="4"
                                        maxlength="2000"
                                        placeholder="Tell us more about the problem..."
                                        class="w-full rounded-xl
                                               border border-gray-300
                                               px-4 py-3
                                               focus:border-red-500
                                               focus:ring-2
                                               focus:ring-red-100
                                               focus:outline-none"
                                    >{{ old('description') }}</textarea>

                                    @error('description')

                                        <p class="mt-2 text-sm text-red-600">
                                            {{ $message }}
                                        </p>

                                    @enderror

                                </div>


                                {{-- Submit --}}
                                <button
                                    type="submit"
                                    class="rounded-xl
                                           bg-red-600
                                           px-5 py-3
                                           text-sm font-semibold
                                           text-white
                                           hover:bg-red-700
                                           transition"
                                >
                                    Submit Report
                                </button>

                            </form>

                        </details>

                    @else

                        <a
                            href="{{ route('login') }}"
                            class="text-sm font-semibold
                                   text-gray-500
                                   hover:text-red-600 transition"
                        >
                            🚩 Report this design
                        </a>

                    @endauth

                </div>


            </div>

        </div>

    </div>


    {{-- Comments Section --}}
    <div
        id="comments-section"
        class="mt-8 bg-white border border-gray-200
               rounded-2xl shadow-sm p-6"
    >

        <h2 class="text-xl font-bold text-gray-900">

            💬 Comments

            <span class="text-sm font-normal text-gray-500">
                ({{ $design->comments->count() }})
            </span>

        </h2>


        {{-- Comment Form --}}
        @auth

            <form
                action="{{ route('designs.comments.store', $design->id) }}"
                method="POST"
                class="mt-5"
            >

                @csrf

                <textarea
                    name="comment"
                    rows="4"
                    placeholder="Write a comment..."
                    class="w-full rounded-xl border border-gray-300
                           px-4 py-3 focus:border-indigo-500
                           focus:ring-2 focus:ring-indigo-200
                           focus:outline-none resize-none"
                ></textarea>

                @error('comment')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror


                <div class="flex justify-end mt-3">

                    <button
                        type="submit"
                        class="rounded-xl bg-indigo-600
                               px-5 py-3 font-semibold text-white
                               hover:bg-indigo-700 transition"
                    >
                        Post Comment
                    </button>

                </div>

            </form>

        @else

            <div
                class="mt-5 rounded-xl
                       bg-gray-50 border border-gray-200
                       px-5 py-4"
            >

                <p class="text-gray-600">
                    Want to join the conversation?
                </p>

                <a
                    href="{{ route('login') }}"
                    class="inline-block mt-3
                           text-indigo-600 font-semibold
                           hover:text-indigo-700"
                >
                    Login to comment →
                </a>

            </div>

        @endauth


        {{-- Comments List --}}
        <div class="mt-8 space-y-5">

            @forelse ($design->comments as $comment)

                <div class="flex gap-4">

                    {{-- Avatar --}}
                    <div
                        class="w-10 h-10 shrink-0 rounded-full
                               bg-indigo-100 flex items-center
                               justify-center text-indigo-600
                               font-bold"
                    >
                        {{ strtoupper(substr($comment->user->name ?? 'U', 0, 1)) }}
                    </div>


                    {{-- Comment --}}
                    <div class="flex-1">

                        <div class="flex items-center justify-between">

                            <p class="font-semibold text-gray-900">
                                {{ $comment->user->name ?? 'Unknown User' }}
                            </p>

                            <span class="text-xs text-gray-400">
                                {{ $comment->created_at->diffForHumans() }}
                            </span>

                        </div>

                        <p class="mt-1 text-gray-600 leading-6">
                            {{ $comment->comment }}
                        </p>

                    </div>


                    {{-- Delete Own Comment --}}
                    @auth

                        @if ($comment->user_id === auth()->id())

                            <form
                                action="{{ route('designs.comments.delete', $comment->id) }}"
                                method="POST"
                                class="mt-2"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="text-sm text-red-500
                                           hover:text-red-700
                                           font-medium"
                                    onclick="return confirm('Are you sure you want to delete this comment?')"
                                >
                                    Delete
                                </button>

                            </form>

                        @endif

                    @endauth

                </div>

            @empty

                <div
                    class="rounded-xl border-2 border-dashed
                           border-gray-200 p-8 text-center"
                >

                    <p class="text-gray-500">
                        No comments yet.
                    </p>

                    <p class="text-sm text-gray-400 mt-1">
                        Be the first person to comment!
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>


{{-- Image Switcher --}}
<script>

    function changeMainImage(imageUrl, button) {

        const mainImage =
            document.getElementById('main-design-image');

        if (mainImage) {

            mainImage.src = imageUrl;

        }


        document.querySelectorAll('.image-thumbnail')
            .forEach(function (thumbnail) {

                thumbnail.classList.remove('border-indigo-500');

                thumbnail.classList.add('border-transparent');

            });


        button.classList.remove('border-transparent');

        button.classList.add('border-indigo-500');

    }

</script>

@endsection

