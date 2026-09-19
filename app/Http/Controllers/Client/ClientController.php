<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()
            ->where('role', 'client')
            ->withCount([
                'collections',
                'followers',
                'following',
            ]);

        // Search client
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where('name', 'like', '%' . $search . '%');
        }

        $clients = $query
            ->orderByDesc('followers_count')
            ->paginate(12)
            ->withQueryString();

        return view(
            'clients.index',
            compact('clients')
        );
    }
}

