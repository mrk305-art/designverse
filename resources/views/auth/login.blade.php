<x-guest-layout>


{{-- Session Status --}}
<x-auth-session-status
    class="mb-4 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700"
    :status="session('status')"
/>


{{-- Heading --}}
<div class="mb-8">

    <div class="mb-2 text-sm font-bold uppercase tracking-[1.5px] text-indigo-600">
        Welcome Back
    </div>

    <h2 class="mb-2 text-3xl font-bold tracking-tight text-gray-900">
        Sign in to your account
    </h2>

    <p class="text-gray-500">
        Sign in to continue your creative journey
        on DesignVerse.
    </p>

</div>


{{-- Validation Errors --}}
@if ($errors->any())

    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-4">

        <div class="mb-1 font-semibold text-red-700">
            Please check your information.
        </div>

        @foreach ($errors->all() as $error)

            <div class="text-sm text-red-600">
                {{ $error }}
            </div>

        @endforeach

    </div>

@endif


{{-- Login Form --}}
<form
    method="POST"
    action="{{ route('login') }}"
>

    @csrf


    {{-- Email --}}
    <div class="mb-5">

        <label
            for="email"
            class="mb-2 block text-sm font-semibold text-gray-700"
        >
            Email address
        </label>

        <input
            id="email"
            type="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="you@example.com"
            required
            autofocus
            autocomplete="username"
            class="block w-full rounded-xl border border-gray-300
                   bg-white px-4 py-3 text-gray-900
                   outline-none transition
                   placeholder:text-gray-400
                   focus:border-indigo-500
                   focus:ring-2 focus:ring-indigo-100
                   @error('email')
                       border-red-400
                       focus:border-red-500
                       focus:ring-red-100
                   @enderror"
        >

        @error('email')

            <div class="mt-2 text-sm text-red-600">
                {{ $message }}
            </div>

        @enderror

    </div>


    {{-- Password --}}
    <div class="mb-5">

        <label
            for="password"
            class="mb-2 block text-sm font-semibold text-gray-700"
        >
            Password
        </label>

        <input
            id="password"
            type="password"
            name="password"
            placeholder="Enter your password"
            required
            autocomplete="current-password"
            class="block w-full rounded-xl border border-gray-300
                   bg-white px-4 py-3 text-gray-900
                   outline-none transition
                   placeholder:text-gray-400
                   focus:border-indigo-500
                   focus:ring-2 focus:ring-indigo-100
                   @error('password')
                       border-red-400
                       focus:border-red-500
                       focus:ring-red-100
                   @enderror"
        >

        @error('password')

            <div class="mt-2 text-sm text-red-600">
                {{ $message }}
            </div>

        @enderror

    </div>


    {{-- Remember + Forgot --}}
    <div class="mb-6 flex items-center justify-between gap-4">

        <label class="flex cursor-pointer items-center gap-2">

            <input
                id="remember_me"
                type="checkbox"
                name="remember"
                class="h-4 w-4 rounded border-gray-300
                       text-indigo-600
                       focus:ring-2 focus:ring-indigo-200"
            >

            <span class="text-sm text-gray-500">
                Remember me
            </span>

        </label>


        @if (Route::has('password.request'))

            <a
                href="{{ route('password.request') }}"
                class="text-sm font-semibold text-indigo-600
                       hover:text-indigo-700 transition"
            >
                Forgot password?
            </a>

        @endif

    </div>


    {{-- Login Button --}}
    <button
        type="submit"
        class="w-full rounded-xl bg-indigo-600
               px-5 py-3.5 text-sm font-semibold text-white
               transition hover:bg-indigo-700
               focus:outline-none
               focus:ring-2 focus:ring-indigo-200
               focus:ring-offset-2"
    >
        Sign in to DesignVerse
    </button>


    {{-- Register --}}
    <div class="mt-6 text-center text-sm">

        <span class="text-gray-500">
            Don't have an account?
        </span>

        <a
            href="{{ route('register') }}"
            class="ml-1 font-semibold text-indigo-600
                   hover:text-indigo-700 transition"
        >
            Create an account
        </a>

    </div>

</form>


</x-guest-layout>
