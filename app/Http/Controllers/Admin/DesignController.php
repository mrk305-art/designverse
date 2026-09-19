<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Design;
use App\Models\Category;
use Illuminate\Http\Request;

class DesignController extends Controller
{
    public function index(Request $request)
    {
        $query = Design::with([
            'user',
            'category',
            'images',
        ]);


        // Search by design title
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where('title', 'like', "%{$search}%");

        }


        // Filter by designer
        if ($request->filled('designer')) {

            $query->where('user_id', $request->designer);

        }


        // Filter by category
        if ($request->filled('category')) {

            $query->where('category_id', $request->category);

        }


        // Filter by status
        if ($request->filled('status')) {

            $query->where('status', $request->status);

        }


        // Filter by visibility
        if ($request->filled('visibility')) {

            $query->where('visibility', $request->visibility);

        }


        $designs = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();


        // Designers for filter dropdown
        $designers = \App\Models\User::where('role', 'designer')
            ->orderBy('name')
            ->get();


        // Categories for filter dropdown
        $categories = Category::orderBy('name')->get();


        return view('admin.designs.index', compact(
            'designs',
            'designers',
            'categories'
        ));
    }


    public function toggleStatus($id)
    {
        $design = Design::findOrFail($id);

        if ($design->status === 'published') {

            $design->status = 'draft';
            $design->published_at = null;

            $message = 'Design unpublished successfully.';

        } else {

            $design->status = 'published';
            $design->published_at = now();

            $message = 'Design published successfully.';
        }

        $design->save();

        return back()->with('success', $message);
    }
}