<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $savedDesignsCount = Auth::user()
            ->savedDesigns()
            ->count();

        $likedDesignsCount = Auth::user()
            ->designLikes()
            ->count();

        $collectionsCount = Auth::user()
            ->collections()
            ->count();

        $followingCount = Auth::user()
            ->following()
            ->count();

            $recentSavedDesigns = Auth::user()
    ->savedDesigns()
    ->with([
        'design.images',
        'design.user',
        'design.category',
    ])
    ->latest()
    ->take(4)
    ->get();

    $recentLikedDesigns = Auth::user()
    ->designLikes()
    ->with([
        'design.images',
        'design.user',
        'design.category',
    ])
    ->latest()
    ->take(4)
    ->get();

    $recentFollowing = Auth::user()
    ->following()
    ->with('following')
    ->latest()
    ->take(4)
    ->get();

        return view(
            'client.dashboard',
            compact(
                'savedDesignsCount',
                'likedDesignsCount',
                'collectionsCount',
                'followingCount',
                'recentSavedDesigns',
                'recentLikedDesigns',
                'recentFollowing'
            )
        );

    }
}
