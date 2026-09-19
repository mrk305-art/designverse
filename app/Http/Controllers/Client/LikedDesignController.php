<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LikedDesignController extends Controller
{
    public function index()
    {
        $likedDesigns = Auth::user()
            ->designLikes()
            ->with([
                'design.images',
                'design.category',
                'design.user',
            ])
            ->latest()
            ->paginate(12);

        return view(
            'client.liked-designs',
            compact('likedDesigns')
        );
    }
}