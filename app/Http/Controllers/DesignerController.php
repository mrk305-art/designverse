<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DesignerController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()

            // Sirf designers
            ->where('role', 'designer')

            // Sirf woh designers jinke published public designs hain
            ->whereHas('designs', function ($q) {
                $q->where('status', 'published')
                  ->where('visibility', 'public');
            })

            ->withCount([
                'designs' => function ($q) {
                    $q->where('status', 'published')
                      ->where('visibility', 'public');
                },
                'followers',
            ]);

        // Search designer
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(
                'name',
                'like',
                '%' . $search . '%'
            );
        }

        $designers = $query
            ->orderByDesc('followers_count')
            ->paginate(12)
            ->withQueryString();

        // Client ke liye alag page
        if (auth()->check() && auth()->user()->role === 'client') {

            return view(
                'client.designers.index',
                compact('designers')
            );
        }

        // Public designers page
        return view(
            'designers.index',
            compact('designers')
        );
    }
}

