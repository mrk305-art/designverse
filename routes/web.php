<?php

use Illuminate\Support\Facades\Route;

// =====================================================
// CONTROLLERS
// =====================================================

// Profile
use App\Http\Controllers\ProfileController;

// Home
use App\Http\Controllers\HomeController;

// Designer
use App\Http\Controllers\Designer\DashboardController as DesignerDashboardController;
use App\Http\Controllers\DesignerController;
use App\Http\Controllers\DesignerProfileController;
use App\Http\Controllers\DesignerProfileEditController;
use App\Http\Controllers\FollowersController;
use App\Http\Controllers\SavedDesignController;

// Client
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ClientProfileController;
use App\Http\Controllers\Client\ClientProfileEditController;
use App\Http\Controllers\Client\LikedDesignController;
use App\Http\Controllers\Client\ClientFollowingController;
use App\Http\Controllers\Client\ClientFollowersController;




// Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\DesignController as AdminDesignController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;

// Designs / Explore
use App\Http\Controllers\DesignController;
use App\Http\Controllers\ExploreController;

// Notifications
use App\Http\Controllers\NotificationController;

// Collections
use App\Http\Controllers\CollectionController;

// Reports
use App\Http\Controllers\ReportController;


// =====================================================
// PUBLIC ROUTES
// Guest + Authenticated users can access
// =====================================================

// Home
Route::get('/', [HomeController::class, 'index'])
    ->name('home');


// Explore
Route::get('/explore', [ExploreController::class, 'index'])
    ->name('explore');

     Route::get('/designs/{id}', [DesignController::class, 'show'])
    ->whereNumber('id')
->name('designs.show');


// Designers
Route::get('/designers', [DesignerController::class, 'index'])
    ->name('designers.index');

    Route::get('/clients', [ClientController::class, 'index'])
    ->name('clients.index');


// Design Details
  

// Designer Public Profile
Route::get('/designer/{id}', [
    DesignerProfileController::class,
    'show'
])
->whereNumber('id')
->name('designer.profile');

 // Client Public Profile
Route::get('/client/{id}', [ClientProfileController::class, 'show'])
->whereNumber('id')
->name('client.profile');

      // Designer Followers
Route::get('/designer/{id}/followers', [FollowersController::class, 'index'])
->whereNumber('id')
->name('designer.followers');

// Designer Following
Route::get('/designer/{id}/following', [FollowersController::class, 'following'])
->whereNumber('id')
->name('designer.following');

Route::get('/client/{id}/followers', [ClientFollowersController::class, 'index'])
    ->whereNumber('id')
    ->name('client.followers');

Route::get('/client/{id}/following', [ClientFollowingController::class, 'index'])
    ->whereNumber('id')
    ->name('client.following');



    





// =====================================================
// AUTHENTICATED ROUTES
// Login required
// =====================================================

Route::middleware('auth')->group(function () {


    // =================================================
    // GENERAL DASHBOARD REDIRECT
    // =================================================

    Route::get('/dashboard', function () {

        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'client') {
            return redirect()->route('client.dashboard');
        }

        if ($user->role === 'designer') {
            return redirect()->route('designer.dashboard');
        }

        return redirect()->route('home');

    })->middleware('verified')
      ->name('dashboard');


    // =================================================
    // PROFILE
    // =================================================

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    // =================================================
    // DESIGNER DASHBOARD
    // =================================================

      Route::get('/designer/dashboard', [
        DesignerDashboardController::class,
        'index'
    ])->name('designer.dashboard');


    

    







    // =================================================
    // DESIGNER PROFILE
    // =================================================

    Route::get('/designer/profile/edit', [
        DesignerProfileEditController::class,
        'edit'
    ])->name('designer.profile.edit');

    Route::put('/designer/profile/update', [
        DesignerProfileEditController::class,
        'update'
    ])->name('designer.profile.update');


    // =================================================
    // DESIGNER DESIGNS
    // =================================================

    Route::get('/designs/create', [
        DesignController::class,
        'create'
    ])->name('designs.create');

    Route::post('/designs/store', [
        DesignController::class,
        'store'
    ])->name('designs.store');

    Route::get('/my-designs', [
        DesignController::class,
        'myDesigns'
    ])->name('designer.designs');

    Route::post('/designs/{id}/publish', [
        DesignController::class,
        'publish'
    ])->name('designs.publish');

    Route::post('/designs/{id}/unpublish', [
        DesignController::class,
        'unpublish'
    ])->name('designs.unpublish');

   


    // =================================================
    // CLIENT DASHBOARD
    // =================================================

    Route::get('/client/dashboard', [
        ClientDashboardController::class,
        'index'
    ])->name('client.dashboard');

    




   

    


    // =================================================
    // CLIENT PROFILE
    // =================================================

    Route::get('/client/profile/edit', [
        ClientProfileEditController::class,
        'edit'
    ])->name('client.profile.edit');

    Route::put('/client/profile/update', [
        ClientProfileEditController::class,
        'update'
    ])->name('client.profile.update');

    


    // =================================================
    // CLIENT FEATURES
    // =================================================

    Route::get('/liked-designs', [
        LikedDesignController::class,
        'index'
    ])->name('liked.designs');

    // Route::get('/following', [
    //     FollowingController::class,
    //     'index'
    // ])->name('client.following');

    Route::get('/saved-designs', [
        SavedDesignController::class,
        'index'
    ])->name('saved.designs');


    // =================================================
    // DESIGN INTERACTIONS
    // =================================================

    // Like / Unlike
    Route::post('/designs/{id}/like', [
        DesignController::class,
        'toggleLike'
    ])->name('designs.like');


    // Follow / Unfollow
    Route::post('/users/{userId}/follow', [
        DesignController::class,
        'toggleFollow'
    ])->name('users.follow');


    // Comments
    Route::post('/designs/{id}/comments', [
        DesignController::class,
        'addComment'
    ])->name('designs.comments.store');


    // Delete Own Comment
    Route::delete('/comments/{id}', [
        DesignController::class,
        'deleteComment'
    ])->name('designs.comments.delete');


    // Save Page
    Route::get('/designs/{id}/save', [
        DesignController::class,
        'save'
    ])->name('designs.save');


    // Direct Save
    Route::post('/designs/{id}/save-direct', [
        DesignController::class,
        'saveDirect'
    ])->name('designs.saveDirect');


    // Save To Collection
    Route::post('/designs/{id}/save-to-collection', [
        DesignController::class,
        'saveToCollection'
    ])->name('designs.saveToCollection');


    // Unsave
    Route::delete('/designs/{id}/unsave', [
        DesignController::class,
        'unsave'
    ])->name('designs.unsave');


    // =================================================
    // COLLECTIONS
    // =================================================

    Route::get('/collections', [
        CollectionController::class,
        'index'
    ])->name('collections.index');

    Route::get('/collections/create', [
        CollectionController::class,
        'create'
    ])->name('collections.create');

    Route::post('/collections', [
        CollectionController::class,
        'store'
    ])->name('collections.store');

    Route::get('/collections/{id}', [
        CollectionController::class,
        'show'
    ])->name('collections.show');

    Route::get('/collections/{id}/edit', [
        CollectionController::class,
        'edit'
    ])->name('collections.edit');

    Route::put('/collections/{id}', [
        CollectionController::class,
        'update'
    ])->name('collections.update');

    Route::delete('/collections/{id}', [
        CollectionController::class,
        'destroy'
    ])->name('collections.destroy');

    Route::delete(
        '/collections/{collectionId}/designs/{designId}',
        [
            CollectionController::class,
            'removeDesign'
        ]
    )->name('collections.removeDesign');


    // =================================================
    // NOTIFICATIONS
    // =================================================

    Route::get('/notifications', [
        NotificationController::class,
        'index'
    ])->name('notifications.index');

    Route::post('/notifications/{id}/read', [
        NotificationController::class,
        'markAsRead'
    ])->name('notifications.read');

    Route::post('/notifications/read-all', [
        NotificationController::class,
        'markAllAsRead'
    ])->name('notifications.readAll');

    Route::get('/notifications/{id}/redirect', [
        NotificationController::class,
        'redirect'
    ])->name('notifications.redirect');


    // =================================================
    // REPORT DESIGN
    // =================================================

    Route::post('/designs/{designId}/report', [
        ReportController::class,
        'store'
    ])->name('designs.report');


    // =================================================
    // ADMIN DASHBOARD
    // =================================================

    Route::get('/admin/dashboard', [
        AdminDashboardController::class,
        'index'
    ])->middleware('admin')
      ->name('admin.dashboard');


    // =================================================
    // ADMIN USERS
    // =================================================

    Route::get('/admin/users', [
        AdminUserController::class,
        'index'
    ])->middleware('admin')
      ->name('admin.users.index');

    Route::get('/admin/users/{id}', [
        AdminUserController::class,
        'show'
    ])->middleware('admin')
      ->name('admin.users.show');

    Route::post('/admin/users/{id}/toggle-status', [
        AdminUserController::class,
        'toggleStatus'
    ])->middleware('admin')
      ->name('admin.users.toggleStatus');


    // =================================================
    // ADMIN DESIGNS
    // =================================================

    Route::get('/admin/designs', [
        AdminDesignController::class,
        'index'
    ])->middleware('admin')
      ->name('admin.designs.index');

    Route::post('/admin/designs/{id}/toggle-status', [
        AdminDesignController::class,
        'toggleStatus'
    ])->middleware('admin')
      ->name('admin.designs.toggleStatus');


    // =================================================
    // ADMIN CATEGORIES
    // =================================================

    Route::get('/admin/categories', [
        AdminCategoryController::class,
        'index'
    ])->middleware('admin')
      ->name('admin.categories.index');

    Route::get('/admin/categories/create', [
        AdminCategoryController::class,
        'create'
    ])->middleware('admin')
      ->name('admin.categories.create');

    Route::post('/admin/categories', [
        AdminCategoryController::class,
        'store'
    ])->middleware('admin')
      ->name('admin.categories.store');

    Route::get('/admin/categories/{id}/edit', [
        AdminCategoryController::class,
        'edit'
    ])->middleware('admin')
      ->name('admin.categories.edit');

    Route::put('/admin/categories/{id}', [
        AdminCategoryController::class,
        'update'
    ])->middleware('admin')
      ->name('admin.categories.update');

    Route::delete('/admin/categories/{id}', [
        AdminCategoryController::class,
        'destroy'
    ])->middleware('admin')
      ->name('admin.categories.destroy');


    // =================================================
    // ADMIN REPORTS
    // =================================================

    Route::get('/admin/reports', [
        ReportController::class,
        'adminIndex'
    ])->middleware('admin')
      ->name('admin.reports.index');

    Route::get('/admin/reports/{id}', [
        ReportController::class,
        'show'
    ])->middleware('admin')
      ->name('admin.reports.show');

    Route::post('/admin/reports/{id}/status', [
        ReportController::class,
        'updateStatus'
    ])->middleware('admin')
      ->name('admin.reports.updateStatus');

});


// =====================================================
// AUTH ROUTES - LARAVEL BREEZE
// =====================================================

require __DIR__ . '/auth.php';

