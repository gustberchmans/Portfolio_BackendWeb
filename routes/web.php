<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\NewsFeedController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfilePictureController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;

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

Route::post('/profile-picture', [ProfilePictureController::class, 'update'])->name('profile.picture.update');

Route::get('/news-feed/{news}', [NewsFeedController::class, 'show'])->name('news-feed.show');

// Admin FAQ Route
Route::get('/admin/faq', function () {
    return view('faq.admin'); // Separate Blade file for admin FAQ
})->name('admin.faq')->middleware('auth');

// Guest User FAQ Route (accessible to everyone, no authentication required)
Route::get('/faq', [FaqController::class, 'index'])->name('user.faq');

// Admin FAQ Route
Route::middleware('auth')->group(function () {
    Route::get('/admin/faq', [FaqController::class, 'admin'])->name('faq.admin'); // Admin-specific FAQ

    // Admin FAQ Management Routes
    Route::get('/faq/create', [FaqController::class, 'create'])->name('faq.create');
    Route::post('/faq', [FaqController::class, 'store'])->name('faq.store');
    Route::get('/faq/{faq}/edit', [FaqController::class, 'edit'])->name('faq.edit');
    Route::put('/faq/{faq}', [FaqController::class, 'update'])->name('faq.update');
    Route::delete('/faq/{faq}', [FaqController::class, 'destroy'])->name('faq.destroy');
});

Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');

Route::get('/contact', [ContactController::class, 'showForm'])->name('contact');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');
// Route to display the reply form
Route::middleware('auth')->group(function () {
    // Admin contacts index route
    Route::get('/admin/contacts', [ContactController::class, 'index'])->name('admin.contacts.index');

    // Reply to a contact message
    Route::get('/admin/contacts/{contact}/reply', [ContactController::class, 'showReplyForm'])->name('admin.contacts.reply');
    Route::post('/admin/contacts/{contact}/reply', [ContactController::class, 'sendReply'])->name('admin.contacts.reply.send');
});



require __DIR__.'/auth.php';
