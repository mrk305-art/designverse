<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;

class ClientFollowersController extends Controller
{
    public function index($id)
    {
        $client = User::where('role', 'client')
            ->findOrFail($id);

        $followers = $client->followers()
            ->with('follower')
            ->latest()
            ->paginate(20);

        return view('client.followers', compact(
            'client',
            'followers'
        ));
    }
}