<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Design;
use App\Models\Category;
use App\Models\DesignLike;
use App\Models\DesignComment;
use App\Models\AdminActivity;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $totalDesigners = User::where(
            'role',
            'designer'
        )->count();

        $totalClients = User::where(
            'role',
            'client'
        )->count();

        $totalDesigns = Design::count();

        $totalLikes = DesignLike::count();

        $totalComments = DesignComment::count();

        $publishedDesigns = Design::where(
            'status',
            'published'
        )->count();

        $draftDesigns = Design::where(
            'status',
            'draft'
        )->count();

        $totalCategories = Category::count();

        $activeUsers = User::where(
            'status',
            1
        )->count();

        $pendingReports = \App\Models\Report::where(
    'status',
    'pending'
)->count();


        // Recent Users
        $recentUsers = User::latest()
            ->take(5)
            ->get();


        // Recent Designs
        $recentDesigns = Design::with([
            'user',
            'images',
        ])
            ->latest()
            ->take(5)
            ->get();


        // Recent Admin Activities
        $recentActivities = AdminActivity::with([
            'user',
            'design',
        ])
            ->latest()
            ->take(10)
            ->get();


        return view('admin.dashboard', compact(
            'totalUsers',
            'totalDesigners',
            'totalClients',
            'totalDesigns',
            'totalLikes',
            'totalComments',
            'publishedDesigns',
            'draftDesigns',
            'totalCategories',
            'activeUsers',
            'pendingReports',
            'recentUsers',
            'recentDesigns',
            'recentActivities'
        ));
    }
}