<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\NewsFeedController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/dashboard', 'dashboard')->middleware(['auth'])->name('dashboard');

// routes/web.php

Route::get('/admin-dashboard', function () {
    if (Auth::check() && Auth::user()->isAdmin) {
        return view('admin-dashboard');  // Only allow admins to view the admin dashboard
    }
    return redirect()->route('dashboard')->with('error', 'Access denied: Admins only.');
})->middleware(['auth'])->name('admin.dashboard');

Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');


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

Route::get('/dashboard', function () {
    if (Auth::check() && Auth::user()->isAdmin) {
        // If the user is an admin, redirect them to the admin dashboard
        return redirect()->route('admin.dashboard');
    }
    // If the user is not an admin, continue to the regular user dashboard
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Show the user creation form admin only
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

// Store the new user in the database
Route::post('/users', [UserController::class, 'store'])->name('users.store');

Route::middleware(['auth'])->group(function () {  // admin only
    Route::get('/news_feed/create', [NewsFeedController::class, 'create'])->name('news_feed.create');
    Route::post('/news_feed', [NewsFeedController::class, 'store'])->name('news_feed.store');
});

Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');

Route::get('/admin-dashboard', [AdminController::class, 'index'])->middleware(['auth'])->name('admin.dashboard');

Route::get('/admin/news-feed', [NewsFeedController::class, 'index'])->middleware(['auth'])->name('news_feed.news-feed');

// Route to show the create news article form
Route::get('/news-feed/create', [NewsFeedController::class, 'create'])->name('news-feed.create')->middleware('auth');

// Route to store the new news article
Route::post('/news-feed', [NewsFeedController::class, 'store'])->name('news-feed.store')->middleware('auth');

// Route to delete a news article
Route::delete('/news-feed/{news}', [NewsFeedController::class, 'destroy'])->name('news-feed.destroy')->middleware('auth');
// Resource route for NewsFeed
Route::resource('news', NewsFeedController::class);
Route::get('/news-feed/{news}/edit', [NewsFeedController::class, 'edit'])->name('news-feed.edit');
Route::put('/news-feed/{news}', [NewsFeedController::class, 'update'])->name('news-feed.update');




require __DIR__.'/auth.php';
