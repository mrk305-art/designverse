<div class="border-t border-gray-100 p-5">

<div class="flex items-center">

<div class="w-11 h-11 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold">

{{ strtoupper(substr(Auth::user()->name,0,1)) }}

</div>

<div class="ml-3">

<h4 class="font-semibold">

{{ Auth::user()->name }}

</h4>

<p class="text-sm text-gray-500">

Designer

</p>

</div>

</div>

<button
class="mt-5 w-full rounded-xl bg-red-500 hover:bg-red-600 transition text-white py-3">

Logout

</button>

</div>