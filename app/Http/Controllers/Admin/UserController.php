<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
{
    $query = User::query();

    // Search by name, username or email
    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {

            $q->where('name', 'like', "%{$search}%")
              ->orWhere('username', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");

        });
    }


    // Filter by role
    if ($request->filled('role')) {

        $query->where('role', $request->role);

    }


    // Filter by status
    if ($request->filled('status')) {

        $query->where('status', $request->status);

    }


    $users = $query
        ->latest()
        ->paginate(15)
        ->withQueryString();


    return view('admin.users.index', compact('users'));
}

    public function show($id)
    {
        $user = User::with([
            'designs',
            'designLikes',
            'designComments',
            'followers',
        ])->findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    public function toggleStatus($id)
{
$user = User::findOrFail($id);


// Admin khud ko deactivate nahi kar sakta
if ($user->id === auth()->id()) {
    return back()->with('error', 'You cannot deactivate your own account.');
}

$user->status = $user->status ? 0 : 1;

$user->save();

return back()->with(
    'success',
    $user->status
        ? 'User activated successfully.'
        : 'User deactivated successfully.'
);


}

}
