<nav class="flex-1 py-6">

<a href="{{ route('designer.dashboard') }}" class="flex items-center gap-4 mx-4 px-5 py-3 rounded-xl bg-indigo-50 text-indigo-600 font-semibold">

    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M3 12l9-9 9 9M4 10v10h16V10"/>
    </svg>

    Dashboard

</a>

<a href="{{ route('designer.designs') }}" class="flex items-center gap-4 mx-4 mt-2 px-5 py-3 rounded-xl hover:bg-gray-100">

    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"/>
    </svg>

    My Designs

</a>

<a href="{{ route('collections.index') }}"
   class="flex items-center gap-4 mx-4 mt-2 px-5 py-3 rounded-xl hover:bg-gray-100">

    <svg class="w-5 h-5"
         fill="none"
         stroke="currentColor"
         viewBox="0 0 24 24">

        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M3 7h18M3 7l2 14h14l2-14M8 7V5a4 4 0 018 0v2"
        />

    </svg>

    My Collections

</a>

<a href="{{ route('saved.designs') }}"
   class="flex items-center gap-4 mx-4 mt-2 px-5 py-3 rounded-xl hover:bg-gray-100">

    <svg class="w-5 h-5"
         fill="none"
         stroke="currentColor"
         viewBox="0 0 24 24">

        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M5 5a2 2 0 012-2h10a2 2 0 012 2v17l-7-4-7 4V5z"
        />

    </svg>

    Saved Designs

</a>

<a href="{{ route('designs.create') }}" class="flex items-center gap-4 mx-4 mt-2 px-5 py-3 rounded-xl hover:bg-gray-100">

    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M12 4v16m8-8H4"/>
    </svg>

    Upload Design

</a>

</nav>