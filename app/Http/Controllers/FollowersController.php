<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowersController extends Controller
{
    public function index($id)
    {
        $designer = User::findOrFail($id);

        $followers = $designer->followers()
            ->with('follower')
            ->latest()
            ->paginate(20);

        return view('designer.followers', compact(
            'designer',
            'followers'
        ));
    }

    
public function following($id)
{
    $designer = User::findOrFail($id);

    $following = $designer->following()
        ->with('following')
        ->latest()
        ->paginate(20);

    return view('designer.following', compact(
        'designer',
        'following'
    ));
}


}

