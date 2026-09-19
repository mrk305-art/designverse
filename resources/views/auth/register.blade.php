<x-guest-layout>


{{-- Heading --}}
<div class="mb-8">

    <div class="mb-2 text-sm font-bold uppercase tracking-[1.5px] text-indigo-600">
        Get Started
    </div>

    <h2 class="mb-2 text-3xl font-bold tracking-tight text-gray-900">
        Create your account
    </h2>

    <p class="text-gray-500">
        Join DesignVerse and become part of our creative community.
    </p>

</div>


{{-- Validation Errors --}}
@if ($errors->any())

    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-4">

        <strong class="text-sm font-semibold text-red-700">
            Please fix the following:
        </strong>

        <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-600">

            @foreach ($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

            @endforeach

        </ul>

    </div>

@endif


{{-- Register Form --}}
<form method="POST" action="{{ route('register') }}">

    @csrf


    {{-- Name --}}
    <div class="mb-5">

        <label
            for="name"
            class="mb-2 block text-sm font-semibold text-gray-700"
        >
            Full Name
        </label>

        <input
            id="name"
            type="text"
            name="name"
            value="{{ old('name') }}"
            placeholder="Enter your full name"
            required
            autofocus
            autocomplete="name"
            class="block w-full rounded-xl border border-gray-300
                   bg-white px-4 py-3 text-gray-900
                   outline-none transition
                   placeholder:text-gray-400
                   focus:border-indigo-500
                   focus:ring-2 focus:ring-indigo-100"
        >

        @error('name')

            <div class="mt-2 text-sm text-red-600">
                {{ $message }}
            </div>

        @enderror

    </div>


    {{-- Username --}}
    <div class="mb-5">

        <label
            for="username"
            class="mb-2 block text-sm font-semibold text-gray-700"
        >
            Username
        </label>

        <input
            id="username"
            type="text"
            name="username"
            value="{{ old('username') }}"
            placeholder="Choose a username"
            required
            autocomplete="username"
            class="block w-full rounded-xl border border-gray-300
                   bg-white px-4 py-3 text-gray-900
                   outline-none transition
                   placeholder:text-gray-400
                   focus:border-indigo-500
                   focus:ring-2 focus:ring-indigo-100"
        >

        @error('username')

            <div class="mt-2 text-sm text-red-600">
                {{ $message }}
            </div>

        @enderror

    </div>


    {{-- Email --}}
    <div class="mb-5">

        <label
            for="email"
            class="mb-2 block text-sm font-semibold text-gray-700"
        >
            Email Address
        </label>

        <input
            id="email"
            type="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="you@example.com"
            required
            autocomplete="email"
            class="block w-full rounded-xl border border-gray-300
                   bg-white px-4 py-3 text-gray-900
                   outline-none transition
                   placeholder:text-gray-400
                   focus:border-indigo-500
                   focus:ring-2 focus:ring-indigo-100"
        >

        @error('email')

            <div class="mt-2 text-sm text-red-600">
                {{ $message }}
            </div>

        @enderror

    </div>


    {{-- Account Type --}}
    <div class="mb-5">

        <label
            for="role"
            class="mb-2 block text-sm font-semibold text-gray-700"
        >
            Account Type
        </label>

        <select
            id="role"
            name="role"
            required
            class="block w-full rounded-xl border border-gray-300
                   bg-white px-4 py-3 text-gray-900
                   outline-none transition
                   focus:border-indigo-500
                   focus:ring-2 focus:ring-indigo-100"
        >

            <option
                value="designer"
                {{ old('role', 'designer') === 'designer' ? 'selected' : '' }}
            >
                Designer
            </option>

            <option
                value="client"
                {{ old('role') === 'client' ? 'selected' : '' }}
            >
                Client
            </option>

        </select>

        @error('role')

            <div class="mt-2 text-sm text-red-600">
                {{ $message }}
            </div>

        @enderror

    </div>


    {{-- Passwords --}}
    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

        {{-- Password --}}
        <div class="mb-1">

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
                placeholder="Create password"
                required
                autocomplete="new-password"
                class="block w-full rounded-xl border border-gray-300
                       bg-white px-4 py-3 text-gray-900
                       outline-none transition
                       placeholder:text-gray-400
                       focus:border-indigo-500
                       focus:ring-2 focus:ring-indigo-100"
            >

            @error('password')

                <div class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </div>

            @enderror

        </div>


        {{-- Confirm Password --}}
        <div class="mb-1">

            <label
                for="password_confirmation"
                class="mb-2 block text-sm font-semibold text-gray-700"
            >
                Confirm Password
            </label>

            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                placeholder="Repeat password"
                required
                autocomplete="new-password"
                class="block w-full rounded-xl border border-gray-300
                       bg-white px-4 py-3 text-gray-900
                       outline-none transition
                       placeholder:text-gray-400
                       focus:border-indigo-500
                       focus:ring-2 focus:ring-indigo-100"
            >

            @error('password_confirmation')

                <div class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </div>

            @enderror

        </div>

    </div>


    {{-- Submit --}}
    <button
        type="submit"
        class="mt-6 w-full rounded-xl bg-indigo-600
               px-5 py-3.5 text-sm font-semibold text-white
               transition hover:bg-indigo-700
               focus:outline-none
               focus:ring-2 focus:ring-indigo-200
               focus:ring-offset-2"
    >
        Create Account
        <span class="ml-1">→</span>
    </button>


    {{-- Login Link --}}
    <div class="mt-6 text-center text-sm">

        <span class="text-gray-500">
            Already have an account?
        </span>

        <a
            href="{{ route('login') }}"
            class="ml-1 font-semibold text-indigo-600
                   hover:text-indigo-700 transition"
        >
            Sign in
        </a>

    </div>

</form>


</x-guest-layout>
