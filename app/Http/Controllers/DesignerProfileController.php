<?php

namespace App\Http\Controllers;

use App\Models\User;

class DesignerProfileController extends Controller
{
    public function show($id)
    {        
        $designer = User::with([
            'designs' => function ($query) {
                $query->where('status', 'published')
                    ->where('visibility', 'public')
                    ->with([
                        'images',
                        'category'
                    ])
                    ->withCount('likes')
                    ->latest();
            }
        ])
        ->withCount([
            'followers',
            'following',
            'designs' => function ($query) {
                $query->where('status', 'published')
                    ->where('visibility', 'public');
            }
        ])
        ->findOrFail($id);

        $isFollowing = false;

        if (auth()->check()) {

            $isFollowing = $designer->followers()
                ->where('follower_id', auth()->id())
                ->exists();
        }

        // Client ke liye client profile page
        if (auth()->check() && auth()->user()->role === 'client') {

            return view(
                'client.designers.profile',
                compact(
                    'designer',
                    'isFollowing'
                )
            );
        }

        // Existing designer/public profile
        return view(
            'designer.profile',
            compact(
                'designer',
                'isFollowing'
            )
        );
    }
}