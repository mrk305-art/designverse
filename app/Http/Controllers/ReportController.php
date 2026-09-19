<?php

namespace App\Http\Controllers;

use App\Models\Design;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Store a new design report.
     */
    public function store(Request $request, $designId)
    {
        $validated = $request->validate([
            'reason' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        $design = Design::where('status', 'published')
            ->where('visibility', 'public')
            ->findOrFail($designId);

        // User apne design ko report nahi kar sakta
        if ($design->user_id === auth()->id()) {
            return back()->with(
                'error',
                'You cannot report your own design.'
            );
        }

        // Same user same design ko multiple pending reports nahi kar sakta
        $existingReport = Report::where('user_id', auth()->id())
            ->where('design_id', $design->id)
            ->where('status', 'pending')
            ->exists();

        if ($existingReport) {
            return back()->with(
                'error',
                'You have already reported this design.'
            );
        }

        Report::create([
            'user_id' => auth()->id(),
            'design_id' => $design->id,
            'reason' => $validated['reason'],
            'description' => $validated['description'] ?? null,
            'status' => 'pending',
        ]);

        return back()->with(
            'success',
            'Report submitted successfully. Our team will review it.'
        );
    }

    public function adminIndex()
{
    $reports = Report::with([
        'user',
        'design.user',
    ])
    ->latest()
    ->get();

    return view('admin.reports.index', compact('reports'));
}

public function show($id)
{
    $report = Report::with([
        'user',
        'design.user',
        'design.category',
        'design.images',
    ])->findOrFail($id);

    return view(
        'admin.reports.show',
        compact('report')
    );
}

public function updateStatus(Request $request, $id)
{
    $validated = $request->validate([
        'status' => [
            'required',
            'in:pending,reviewed,resolved,rejected',
        ],
    ]);

    $report = Report::findOrFail($id);

    $report->update([
        'status' => $validated['status'],
    ]);

    return back()->with(
        'success',
        'Report status updated successfully.'
    );
}




}