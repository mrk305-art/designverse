<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;

class ClientFollowingController extends Controller
{
    public function index($id)
    {
        $client = User::where('role', 'client')
            ->findOrFail($id);

        $following = $client->following()
            ->with('following')
            ->latest()
            ->paginate(20);

        return view('client.following', compact(
            'client',
            'following'
        ));
    }
}