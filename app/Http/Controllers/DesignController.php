<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Design;
use App\Models\DesignImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\DesignLike;
use App\Models\Follow;
use App\Models\DesignComment;
use App\Models\Notification;
use App\Models\AdminActivity;

class DesignController extends Controller
{
    /**
     * Show upload design form.
     */
    public function create()
    {
        $categories = Category::where('status', true)
            ->orderBy('name')
            ->get();

        return view('designer.designs.create', compact('categories'));
    }

    /**
     * Store a new design.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],

            'category_id' => [
                'required',
                'integer',
                'exists:categories,id'
            ],

            'description' => [
                'required',
                'string'
            ],

            'images' => [
                'required',
                'array',
                'min:1',
                'max:10'
            ],

            'images.*' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048'
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create designs directory
        |--------------------------------------------------------------------------
        */

        $designDirectory = public_path('designs');

        if (!file_exists($designDirectory)) {
            mkdir($designDirectory, 0755, true);
        }

        /*
        |--------------------------------------------------------------------------
        | Create Design
        |--------------------------------------------------------------------------
        */

        $design = Design::create([
            'user_id' => auth()->id(),

            'category_id' => $validated['category_id'],

            'title' => $validated['title'],

            'slug' => Str::slug($validated['title'])
                . '-' . Str::lower(Str::random(6)),

            'description' => $validated['description'],

            'visibility' => 'public',

            'status' => 'draft',

            'published_at' => null,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload Multiple Images
        |--------------------------------------------------------------------------
        */

        foreach ($request->file('images') as $index => $image) {

            $imageName = time() . '_' . Str::random(10) . '.'
                . $image->extension();

            $image->move(
                $designDirectory,
                $imageName
            );

            DesignImage::create([
                'design_id' => $design->id,
                'image' => $imageName,
                'sort_order' => $index + 1,
            ]);
        }

        AdminActivity::createActivity(
    'design_uploaded',
    auth()->user()->name .
        ' uploaded a new design "' .
        $design->title . '"',
    auth()->id(),
    $design->id
);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Design saved successfully!');
    }

    


    /**
     * Show a single design.
     */
 public function show($id)
{
    $design = Design::with(['images', 'category', 'user' , 'comments.user'])
        ->withCount('likes')
        ->findOrFail($id);

        $design->user->loadCount('followers');

    $design->increment('views');

    $userLiked = false;
    $userFollowed = false;

    if (auth()->check()) {

        $userLiked = $design->likes()
            ->where('user_id', auth()->id())
            ->exists();

        $userFollowed = $design->user
            ->followers()
            ->where('follower_id', auth()->id())
            ->exists();
    }

    return view('designer.designs.show', compact(
        'design',
        'userLiked',
        'userFollowed'
    ));
}


public function toggleLike($id)
{
    $design = Design::with('user')->findOrFail($id);

    // Check if user already liked
    $like = DesignLike::where('user_id', auth()->id())
        ->where('design_id', $design->id)
        ->first();

    if ($like) {

        // Unlike
        $like->delete();

        // Remove related like notification
        Notification::where('user_id', $design->user_id)
            ->where('from_user_id', auth()->id())
            ->where('design_id', $design->id)
            ->where('type', 'like')
            ->delete();

        $message = 'Like removed';

    } else {

        // Like
        DesignLike::create([
            'user_id' => auth()->id(),
            'design_id' => $design->id,
        ]);

        // Don't notify yourself
        if (auth()->id() !== $design->user_id) {

            Notification::create([
                'user_id' => $design->user_id,
                'from_user_id' => auth()->id(),
                'design_id' => $design->id,
                'type' => 'like',
                'message' => auth()->user()->name .
                    ' liked your design "' .
                    $design->title . '"',
            ]);
        }

        $message = 'Design liked';
    }

    return back()->with('success', $message);
}



public function toggleFollow($userId)
{
    $user = \App\Models\User::findOrFail($userId);

    // User apne aap ko follow nahi kar sakta
    if (auth()->id() == $user->id) {
        return back()->with('error', 'You cannot follow yourself.');
    }

    // Check existing follow
    $follow = Follow::where('follower_id', auth()->id())
        ->where('following_id', $user->id)
        ->first();

    if ($follow) {

        // Unfollow
        $follow->delete();

        // Related follow notification remove karein
        Notification::where('user_id', $user->id)
            ->where('from_user_id', auth()->id())
            ->where('type', 'follow')
            ->delete();

        $message = 'Unfollowed successfully';

    } else {

        // Follow
        Follow::create([
            'follower_id' => auth()->id(),
            'following_id' => $user->id,
        ]);

        // Khud ko notification nahi
        Notification::create([
            'user_id' => $user->id,
            'from_user_id' => auth()->id(),
            'design_id' => null,
            'type' => 'follow',
            'message' => auth()->user()->name .
                ' started following you',
        ]);

        $message = 'Followed successfully';
    }

    return back()->with('success', $message);
}




public function addComment(Request $request, $id)
{
    $validated = $request->validate([
        'comment' => [
            'required',
            'string',
            'max:1000',
        ],
    ]);

    $design = Design::with('user')->findOrFail($id);

    DesignComment::create([
        'design_id' => $design->id,
        'user_id' => auth()->id(),
        'comment' => $validated['comment'],
    ]);

    // Khud ke design par comment karne par notification nahi
    if (auth()->id() !== $design->user_id) {

        Notification::create([
            'user_id' => $design->user_id,
            'from_user_id' => auth()->id(),
            'design_id' => $design->id,
            'type' => 'comment',
            'message' => auth()->user()->name .
                ' commented on your design "' .
                $design->title . '"',
        ]);
    }

    return back()->with('success', 'Comment added successfully!');
}



public function deleteComment($id)
{
    $comment = DesignComment::findOrFail($id);

    if ($comment->user_id !== auth()->id()) {
        abort(403, 'You are not allowed to delete this comment.');
    }

    $comment->delete();

    return back()->with('success', 'Comment deleted successfully!');
}


public function publish($id)
{
    $design = Design::where('user_id', auth()->id())
        ->findOrFail($id);

    $design->update([
        'status' => 'published',
        'published_at' => now(),
    ]);

    return back()->with(
        'success',
        'Design published successfully!'
    );
}


public function unpublish($id)
{
    $design = Design::where('user_id', auth()->id())
        ->findOrFail($id);

    $design->update([
        'status' => 'draft',
        'published_at' => null,
    ]);

    return back()->with(
        'success',
        'Design moved back to draft.'
    );
}


public function myDesigns()
{
    $designs = Design::with([
        'images',
        'category'
    ])
    ->where('user_id', auth()->id())
    ->latest()
    ->paginate(12);

    return view('designer.designs.index', compact('designs'));
}

public function save($id)
{
    $design = Design::where('status', 'published')
        ->where('visibility', 'public')
        ->findOrFail($id);

    $collections = auth()->user()
        ->collections()
        ->withCount('designs')
        ->latest()
        ->get();

    if (auth()->user()->role === 'client') {
        return view(
            'client.designs.save',
            compact('design', 'collections')
        );
    }

    return view(
        'designer.designs.save',
        compact('design', 'collections')
    );
}


   public function saveToCollection(Request $request, $id)
{
    $validated = $request->validate([
        'collection_id' => [
            'required',
            'integer',
            'exists:collections,id',
        ],
    ]);

    $collection = auth()->user()
        ->collections()
        ->findOrFail($validated['collection_id']);

    $design = Design::where('status', 'published')
        ->where('visibility', 'public')
        ->findOrFail($id);


    // 1. Saved Designs mein save karein
    $design->saves()->firstOrCreate([
        'user_id' => auth()->id(),
    ]);


    // 2. Collection mein add karein
    if (!$collection->designs()
        ->where('design_id', $design->id)
        ->exists()
    ) {

        $collection->designs()->attach($design->id);
    }


    return redirect()
        ->route('collections.show', $collection->id)
        ->with(
            'success',
            'Design saved to collection successfully!'
        );
}





public function unsave($id)
{
    $design = Design::findOrFail($id);

    $design->saves()
        ->where('user_id', auth()->id())
        ->delete();

    // Save notification bhi remove kar dein
    Notification::where('user_id', $design->user_id)
        ->where('from_user_id', auth()->id())
        ->where('design_id', $design->id)
        ->where('type', 'save')
        ->delete();

    return back()->with(
        'success',
        'Design removed from saved designs.'
    );
}

public function saveDirect($id)
{
    $design = Design::where('status', 'published')
        ->where('visibility', 'public')
        ->findOrFail($id);

    $design->saves()->firstOrCreate([
        'user_id' => auth()->id(),
    ]);

    return redirect()
        ->route('saved.designs')
        ->with('success', 'Design saved successfully!');
}









}