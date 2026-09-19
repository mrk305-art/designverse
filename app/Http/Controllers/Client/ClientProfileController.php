<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;

class ClientProfileController extends Controller
{
    public function show($id)
    {
        $client = User::with([
            'collections'
        ])
        ->withCount([
            'collections',
            'followers',
            'following',
        ])
        ->where('role', 'client')
        ->findOrFail($id);

        $isFollowing = false;

        if (auth()->check()) {
            $isFollowing = auth()->user()
                ->following()
                ->where('following_id', $client->id)
                ->exists();
        }

        return view('profiles.client', compact(
            'client',
            'isFollowing'
        ));
    }
}
