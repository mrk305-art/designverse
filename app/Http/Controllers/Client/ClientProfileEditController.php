<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClientProfileEditController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('client.profile-edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'username' => [
                'required',
                'string',
                'max:255',
                'unique:users,username,' . $user->id,
            ],

            'bio' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],

            'profile_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->bio = $validated['bio'] ?? null;

        if ($request->hasFile('profile_image')) {

            $directory = public_path('profiles');

            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            if (
                $user->profile_image &&
                file_exists(
                    public_path('profiles/' . $user->profile_image)
                )
            ) {
                unlink(
                    public_path('profiles/' . $user->profile_image)
                );
            }

            $imageName = time() . '_' .
                Str::random(10) . '.' .
                $request->file('profile_image')->extension();

            $request->file('profile_image')->move(
                $directory,
                $imageName
            );

            $user->profile_image = $imageName;
        }

        $user->save();

        return redirect()
            ->route('client.dashboard')
            ->with('success', 'Profile updated successfully!');
    }
}