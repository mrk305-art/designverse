<?php

namespace App\Http\Controllers;

use App\Models\Design;
use App\Models\User;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featuredDesigns = Design::with([
            'images',
            'category',
            'user'
        ])
        ->where('status', 'published')
        ->where('visibility', 'public')
        ->withCount('likes')
        ->latest()
        ->take(8)
        ->get();

        $designers = User::where('role', 'designer')
    ->whereHas('designs', function ($query) {
        $query->where('status', 'published')
              ->where('visibility', 'public');
    })
    ->withCount([
        'designs' => function ($query) {
            $query->where('status', 'published')
                  ->where('visibility', 'public');
        },
        'followers'
    ])
    ->latest()
    ->take(6)
    ->get();

        $categories = Category::withCount([
            'designs' => function ($query) {
                $query->where('status', 'published')
                      ->where('visibility', 'public');
            }
        ])
        ->latest()
        ->take(6)
        ->get();

        return view('home', compact(
            'featuredDesigns',
            'designers',
            'categories'
        ));
    }
}