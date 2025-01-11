<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WelcomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/dashboard', 'dashboard')->middleware(['auth'])->name('dashboard');

// routes/web.php

Route::get('/admin-dashboard', function () {
    // Check if the user is logged in and is an admin
    if (Auth::check() && Auth::user()->isAdmin) {
        return view('admin-dashboard');  // Only allow admins to view the admin dashboard
    }

    // Redirect non-admin users to the regular dashboard
    return redirect()->route('dashboard')->with('error', 'Access denied: Admins only.');
})->middleware(['auth'])->name('admin.dashboard');

Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::patch('/users/{user}/toggle-admin', [UserController::class, 'toggleAdmin'])->name('users.toggleAdmin');
});

Route::get('/users', function () {
    if (Auth::check() && Auth::user()->isAdmin) {
        // Admins can access the UserController index method
        return app(UserController::class)->index();
    }
    // Redirect all other users to the dashboard with an error message
    return redirect()->route('dashboard')->with('error', 'Access denied: Admins only.');
})->name('users.index')->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

require __DIR__.'/auth.php';
