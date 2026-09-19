<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>


<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>
    {{ config('app.name', 'DesignVerse') }}
</title>


{{-- Font --}}
<link
    href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap"
    rel="stylesheet"
>


{{-- Tailwind + Vite --}}
@vite([
    'resources/css/app.css',
    'resources/js/app.js'
])


</head>

<body class="min-h-screen bg-gray-50">

<div class="min-h-screen flex">


{{-- =========================================
     LEFT BRAND PANEL
========================================== --}}

<div class="hidden lg:flex lg:w-1/2 bg-gray-900 text-white">

    <div class="flex w-full flex-col justify-between p-10 xl:p-12">


        {{-- Logo --}}
        <a
            href="{{ url('/') }}"
            class="inline-flex w-fit text-3xl font-extrabold tracking-[-1px]"
        >
            <span class="text-white">
                Design
            </span>

            <span class="text-indigo-500">
                Verse
            </span>
        </a>


        {{-- Main Content --}}
        <div class="my-auto max-w-xl pr-8">


            <div
                class="mb-4 text-sm font-bold uppercase
                       tracking-[2px] text-indigo-400"
            >
                Creative Community
            </div>


            <h1
                class="mb-6 text-5xl font-extrabold leading-[1.05]
                       tracking-[-2px] xl:text-6xl"
            >

                Where great

                <span class="text-indigo-500">
                    designs
                </span>

                come to life.

            </h1>


            <p
                class="mb-10 text-lg leading-8 text-gray-400 xl:text-xl"
            >
                Discover inspiring work, connect with
                talented designers, and share your own
                creative journey with the DesignVerse
                community.
            </p>


            {{-- Features --}}
            <div class="flex flex-col gap-6">


                {{-- Feature 1 --}}
                <div class="flex items-center gap-4">

                    <div
                        class="flex h-12 w-12 shrink-0 items-center
                               justify-center rounded-xl
                               bg-indigo-500/20 text-xl text-indigo-400"
                    >
                        ✦
                    </div>

                    <div>

                        <div class="font-semibold text-white">
                            Creative Work
                        </div>

                        <small class="text-gray-500">
                            UI / UX Design
                        </small>

                    </div>

                </div>


                {{-- Feature 2 --}}
                <div class="flex items-center gap-4">

                    <div
                        class="flex h-12 w-12 shrink-0 items-center
                               justify-center rounded-xl
                               bg-indigo-500/20 text-xl text-indigo-400"
                    >
                        ◆
                    </div>

                    <div>

                        <div class="font-semibold text-white">
                            Fresh Ideas
                        </div>

                        <small class="text-gray-500">
                            Brand Identity
                        </small>

                    </div>

                </div>


            </div>

        </div>


        {{-- Footer --}}
        <div class="text-sm text-gray-500">

            ✦ &nbsp;
            Built for designers who love creating.

        </div>


    </div>

</div>


{{-- =========================================
     RIGHT FORM PANEL
========================================== --}}

<div
    class="flex w-full items-center justify-center
           bg-white lg:w-1/2"
>

    <div
        class="w-full max-w-[560px] px-6 py-8
               sm:px-10 md:px-12"
    >


        {{-- Mobile Logo --}}
        <div class="mb-10 text-center lg:hidden">

            <a
                href="{{ url('/') }}"
                class="inline-flex text-3xl font-extrabold
                       tracking-[-1px]"
            >

                <span class="text-gray-900">
                    Design
                </span>

                <span class="text-indigo-500">
                    Verse
                </span>

            </a>

        </div>


        {{-- Login / Register Content --}}

        {{ $slot }}


        {{-- Footer --}}
        <div class="mt-10 text-center">

            <small class="text-sm text-gray-400">

                © {{ date('Y') }} DesignVerse.
                All rights reserved.

            </small>

        </div>


    </div>

</div>


</div>

</body>

</html>
