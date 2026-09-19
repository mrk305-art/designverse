
@extends('layouts.designer')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- Page Header --}}
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-gray-900">
            Upload Design
        </h1>

        <p class="mt-2 text-gray-500">
            Share your creative work with the DesignVerse community.
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

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Upload Form --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm">

        <form
            action="{{ route('designs.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="p-8"
        >

            @csrf


            {{-- Title --}}
            <div class="mb-6">

                <label
                    for="title"
                    class="block text-sm font-semibold text-gray-700 mb-2"
                >
                    Design Title
                </label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="e.g. Modern Banking Dashboard"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3
                           focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                           focus:outline-none transition"
                >

                @error('title')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- Category --}}
            <div class="mb-6">

                <label
                    for="category_id"
                    class="block text-sm font-semibold text-gray-700 mb-2"
                >
                    Category
                </label>

                <select
                    id="category_id"
                    name="category_id"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3
                           focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                           focus:outline-none transition"
                >

                    <option value="">
                        Select a category
                    </option>

                    @foreach ($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>

                @error('category_id')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

                @if ($categories->isEmpty())

                    <p class="mt-2 text-sm text-amber-600">
                        No categories available yet.
                    </p>

                @endif

            </div>


            {{-- Description --}}
            <div class="mb-6">

                <label
                    for="description"
                    class="block text-sm font-semibold text-gray-700 mb-2"
                >
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="6"
                    placeholder="Tell people about your design..."
                    class="w-full rounded-xl border border-gray-300 px-4 py-3
                           focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                           focus:outline-none transition resize-none"
                >{{ old('description') }}</textarea>

                @error('description')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- Multiple Images Upload --}}
            <div class="mb-8">

                <label
                    for="images"
                    class="block text-sm font-semibold text-gray-700 mb-2"
                >
                    Design Images
                </label>

                <div
                    class="border-2 border-dashed border-gray-300 rounded-2xl
                           p-10 text-center hover:border-indigo-400
                           transition"
                >

                    <div class="text-4xl mb-4">
                        🖼️
                    </div>

                    <p class="font-semibold text-gray-700">
                        Upload your design images
                    </p>

                    <p class="text-sm text-gray-500 mt-1 mb-5">
                        JPG, PNG or WEBP — maximum 2MB per image
                    </p>

                    <p class="text-xs text-gray-400 mb-5">
                        You can select up to 10 images
                    </p>

                    <label
                        for="images"
                        class="inline-flex cursor-pointer items-center
                               rounded-xl bg-indigo-600 px-5 py-3
                               font-semibold text-white
                               hover:bg-indigo-700 transition"
                    >
                        Choose Images
                    </label>

                    <input
                        type="file"
                        id="images"
                        name="images[]"
                        accept=".jpg,.jpeg,.png,.webp"
                        multiple
                        class="hidden"
                    >

                    <p
                        id="file-name"
                        class="mt-4 text-sm text-gray-500"
                    >
                        No images selected
                    </p>


                    {{-- Image Preview --}}
                    <div
                        id="image-preview"
                        class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4
                               gap-4 mt-6"
                    ></div>

                </div>

                @error('images')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

                @error('images.*')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- Actions --}}
            <div class="flex items-center justify-end gap-4">

                <a
                    href="{{ route('dashboard') }}"
                    class="px-5 py-3 rounded-xl border border-gray-300
                           text-gray-700 font-semibold
                           hover:bg-gray-50 transition"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-indigo-600
                           text-white font-semibold
                           hover:bg-indigo-700
                           focus:ring-4 focus:ring-indigo-200
                           transition"
                >
                    Save Design
                </button>

            </div>

        </form>

    </div>

</div>


{{-- Multiple Image Preview --}}
<script>

    const imageInput = document.getElementById('images');
    const fileName = document.getElementById('file-name');
    const imagePreview = document.getElementById('image-preview');

    imageInput.addEventListener('change', function () {

        imagePreview.innerHTML = '';

        if (this.files.length === 0) {

            fileName.textContent = 'No images selected';

            return;
        }

        fileName.textContent =
            this.files.length + ' image(s) selected';


        Array.from(this.files).forEach(function (file) {

            const reader = new FileReader();

            reader.onload = function (event) {

                const wrapper = document.createElement('div');

                wrapper.className =
                    'relative overflow-hidden rounded-xl border border-gray-200 bg-gray-50';


                const image = document.createElement('img');

                image.src = event.target.result;

                image.className =
                    'w-full h-32 object-cover';


                wrapper.appendChild(image);

                imagePreview.appendChild(wrapper);

            };

            reader.readAsDataURL(file);

        });

    });

</script>

@endsection

