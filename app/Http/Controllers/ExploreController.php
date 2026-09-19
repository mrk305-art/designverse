<?php

namespace App\Http\Controllers;

use App\Models\Design;
use App\Models\Category;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function index(Request $request)
    {
        $query = Design::with([
            'images',
            'user',
            'category',
            'likes',
        ])
        ->where('status', 'published')
        ->where('visibility', 'public');


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

      
if ($request->filled('search')) {

    $search = $request->search;

    $query->where(function ($q) use ($search) {

        // Design title
        $q->where('title', 'like', '%' . $search . '%')

            // Design description
            ->orWhere(
                'description',
                'like',
                '%' . $search . '%'
            )

            // Designer name
            ->orWhereHas('user', function ($userQuery) use ($search) {

                $userQuery->where(
                    'name',
                    'like',
                    '%' . $search . '%'
                );

            });

    });
}




        /*
        |--------------------------------------------------------------------------
        | Category Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category')) {

            $query->where(
                'category_id',
                $request->category
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Sorting
        |--------------------------------------------------------------------------
        */

        $sort = $request->get('sort', 'latest');

        if ($sort === 'popular') {

            $query->withCount('likes')
                ->orderByDesc('likes_count');

        } elseif ($sort === 'views') {

            $query->orderByDesc('views');

        } else {

            $query->latest();
        }


        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $designs = $query
            ->paginate(12)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        $categories = Category::where('status', true)
            ->orderBy('name')
            ->get();


        return view('explore.index', compact(
            'designs',
            'categories'
        ));
    }
}

