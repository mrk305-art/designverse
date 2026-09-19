
@extends('layouts.designer')

@section('content')

<div class="max-w-3xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-gray-900">
            Edit Profile
        </h1>

        <p class="mt-2 text-gray-500">
            Update your designer profile information.
        </p>

    </div>


    {{-- Validation Errors --}}
    @if ($errors->any())

        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-5">

            <div class="font-semibold text-red-700 mb-2">
                Please fix the following errors:
            </div>

            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Profile Form --}}
    <div class="bg-white border border-gray-200
                rounded-2xl shadow-sm">

        <form
            action="{{ route('designer.profile.update') }}"
            method="POST"
            enctype="multipart/form-data"
            class="p-8"
        >

            @csrf
            @method('PUT')


            {{-- Profile Image --}}
            <div class="mb-8">

                <label class="block text-sm font-semibold
                              text-gray-700 mb-3">
                    Profile Picture
                </label>

                <div class="flex items-center gap-5">

                    {{-- Current Image --}}
                    @if ($user->profile_image)

                        <img
                            src="{{ asset('profiles/' . $user->profile_image) }}"
                            alt="{{ $user->name }}"
                            class="w-20 h-20 rounded-full object-cover
                                   border border-gray-200"
                        >

                    @else

                        <div
                            class="w-20 h-20 rounded-full bg-indigo-100
                                   flex items-center justify-center
                                   text-2xl font-bold text-indigo-600"
                        >
                            {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                        </div>

                    @endif


                    <div>

                        <label
                            for="profile_image"
                            class="inline-flex cursor-pointer
                                   rounded-xl bg-indigo-600
                                   px-5 py-3 font-semibold
                                   text-white hover:bg-indigo-700
                                   transition"
                        >
                            Choose Image
                        </label>

                        <input
                            type="file"
                            id="profile_image"
                            name="profile_image"
                            accept=".jpg,.jpeg,.png,.webp"
                            class="hidden"
                        >

                        <p
                            id="profile-file-name"
                            class="text-sm text-gray-500 mt-2"
                        >
                            JPG, PNG or WEBP — maximum 2MB
                        </p>

                    </div>

                </div>

                @error('profile_image')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- Name --}}
            <div class="mb-6">

                <label
                    for="name"
                    class="block text-sm font-semibold
                           text-gray-700 mb-2"
                >
                    Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full rounded-xl border border-gray-300
                           px-4 py-3 focus:border-indigo-500
                           focus:ring-2 focus:ring-indigo-200
                           focus:outline-none transition"
                >

                @error('name')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- Bio --}}
            <div class="mb-8">

                <label
                    for="bio"
                    class="block text-sm font-semibold
                           text-gray-700 mb-2"
                >
                    Bio
                </label>

                <textarea
                    id="bio"
                    name="bio"
                    rows="5"
                    maxlength="1000"
                    placeholder="Tell people about yourself..."
                    class="w-full rounded-xl border border-gray-300
                           px-4 py-3 focus:border-indigo-500
                           focus:ring-2 focus:ring-indigo-200
                           focus:outline-none transition resize-none"
                >{{ old('bio', $user->bio) }}</textarea>

                @error('bio')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- Actions --}}
            <div class="flex items-center justify-end gap-4">

                <a
                    href="{{ route('designer.profile', $user->id) }}"
                    class="px-5 py-3 rounded-xl
                           border border-gray-300
                           text-gray-700 font-semibold
                           hover:bg-gray-50 transition"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl
                           bg-indigo-600 text-white
                           font-semibold hover:bg-indigo-700
                           focus:ring-4 focus:ring-indigo-200
                           transition"
                >
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</div>


{{-- Selected filename --}}
<script>

    const profileInput =
        document.getElementById('profile_image');

    const profileFileName =
        document.getElementById('profile-file-name');

    profileInput.addEventListener('change', function () {

        if (this.files.length > 0) {

            profileFileName.textContent =
                this.files[0].name;

        } else {

            profileFileName.textContent =
                'JPG, PNG or WEBP — maximum 2MB';

        }

    });

</script>

@endsection

