<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use App\Models\Design;

class DashboardController extends Controller
{
  public function index()
{
    $designs = Design::with(['images', 'category'])
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    $designCount = $designs->count();

    $viewsCount = $designs->sum('views');

    $likesCount = $designs->sum(function ($design) {
        return $design->likes()->count();

    });

         $followersCount = auth()->user()->followers()->count();   


    return view('designer.dashboard', compact(
        'designs',
        'designCount',
        'viewsCount',
        'likesCount',
        'followersCount'
    ));
}
}

