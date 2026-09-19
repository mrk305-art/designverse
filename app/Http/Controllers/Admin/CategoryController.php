<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::withCount('designs');


        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");

            });
        }


        // Status filter
        if ($request->filled('status')) {

            $query->where('status', $request->status);

        }


        $categories = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();


        return view(
            'admin.categories.index',
            compact('categories')
        );
    }


    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
                'unique:categories,name',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:categories,slug',
            ],

            'icon' => [
                'nullable',
                'string',
                'max:255',
            ],

            'status' => [
                'required',
                'boolean',
            ],

        ]);


        // Generate slug automatically
        if (empty($validated['slug'])) {

            $validated['slug'] = Str::slug(
                $validated['name']
            );

        }


        Category::create($validated);


        return redirect()
            ->route('admin.categories.index')
            ->with(
                'success',
                'Category created successfully.'
            );
    }


    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view(
            'admin.categories.edit',
            compact('category')
        );
    }


    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);


        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
                'unique:categories,name,' . $category->id,
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:categories,slug,' . $category->id,
            ],

            'icon' => [
                'nullable',
                'string',
                'max:255',
            ],

            'status' => [
                'required',
                'boolean',
            ],

        ]);


        if (empty($validated['slug'])) {

            $validated['slug'] = Str::slug(
                $validated['name']
            );

        }


        $category->update($validated);


        return redirect()
            ->route('admin.categories.index')
            ->with(
                'success',
                'Category updated successfully.'
            );
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id);


        // Prevent deleting category that has designs
        if ($category->designs()->exists()) {

            return back()->with(
                'error',
                'This category cannot be deleted because it contains designs.'
            );

        }


        $category->delete();


        return redirect()
            ->route('admin.categories.index')
            ->with(
                'success',
                'Category deleted successfully.'
            );
    }
}