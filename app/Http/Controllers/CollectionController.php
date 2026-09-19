<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Design;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = auth()->user()
            ->collections()
            ->withCount('designs')
            ->latest()
            ->get();

        if (auth()->user()->role === 'client') {
            return view(
                'client.collections.index',
                compact('collections')
            );
        }

        return view(
            'designer.collections.index',
            compact('collections')
        );
    }


    public function show($id)
    {
        $collection = auth()->user()
            ->collections()
            ->with([
                'designs.images',
                'designs.category',
                'designs.user',
            ])
            ->findOrFail($id);

        if (auth()->user()->role === 'client') {
            return view(
                'client.collections.show',
                compact('collection')
            );
        }

        return view(
            'designer.collections.show',
            compact('collection')
        );
    }


    public function create(Request $request)
    {
        $designId = $request->query('design_id');

        if (auth()->user()->role === 'client') {
            return view(
                'client.collections.create',
                compact('designId')
            );
        }

        return view(
            'designer.collections.create',
            compact('designId')
        );
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'description' => [
                'nullable',
                'string',
                'max:500',
            ],

            'design_id' => [
                'nullable',
                'integer',
                'exists:designs,id',
            ],
        ]);

        $collection = auth()->user()
            ->collections()
            ->create([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
            ]);


        // Agar design ke liye collection create hui hai
        if (!empty($validated['design_id'])) {

            $design = Design::where('status', 'published')
                ->where('visibility', 'public')
                ->findOrFail($validated['design_id']);


            // Saved Designs mein bhi save karein
            $design->saves()->firstOrCreate([
                'user_id' => auth()->id(),
            ]);


            // Collection mein design attach karein
            if (!$collection->designs()
                ->where('design_id', $design->id)
                ->exists()
            ) {
                $collection->designs()->attach($design->id);
            }
        }


        return redirect()
            ->route('collections.show', $collection->id)
            ->with(
                'success',
                'Collection created successfully!'
            );
    }


    public function edit($id)
    {
        $collection = auth()->user()
            ->collections()
            ->findOrFail($id);


        if (auth()->user()->role === 'client') {
            return view(
                'client.collections.edit',
                compact('collection')
            );
        }

        return view(
            'designer.collections.edit',
            compact('collection')
        );
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'description' => [
                'nullable',
                'string',
                'max:500',
            ],
        ]);


        $collection = auth()->user()
            ->collections()
            ->findOrFail($id);


        $collection->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);


        return redirect()
            ->route('collections.show', $collection->id)
            ->with(
                'success',
                'Collection updated successfully!'
            );
    }


    public function destroy($id)
    {
        $collection = auth()->user()
            ->collections()
            ->findOrFail($id);


        // Pivot relationships remove karein
        $collection->designs()->detach();


        // Collection delete karein
        $collection->delete();


        return redirect()
            ->route('collections.index')
            ->with(
                'success',
                'Collection deleted successfully!'
            );
    }


    public function removeDesign($collectionId, $designId)
    {
        $collection = auth()->user()
            ->collections()
            ->findOrFail($collectionId);


        $collection->designs()->detach($designId);


        return back()->with(
            'success',
            'Design removed from collection successfully!'
        );
    }
}