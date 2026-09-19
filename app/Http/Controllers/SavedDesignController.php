<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class SavedDesignController extends Controller
{
    public function index()
    {
        $savedDesigns = Auth::user()
            ->savedDesigns()
            ->with([
                'design.images',
                'design.category',
                'design.user',
            ])
            ->latest()
            ->paginate(12);

        // Client ke liye Client Saved Designs page
        if (Auth::user()->role === 'client') {
            return view(
                'client.saved-designs',
                compact('savedDesigns')
            );
        }

        // Designer ke liye Designer Saved Designs page
        return view(
            'designer.saved-designs',
            compact('savedDesigns')
        );
    }
}

