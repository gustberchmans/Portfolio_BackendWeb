<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    ProfileController,
    UserController,
    DashboardController,
    WelcomeController,
    NewsFeedController,
    AdminController,
    ProfilePictureController,
    FaqController,
    CategoryController,
    ContactController,
    CommentController,
    MealOrderController
};

// Public Routes
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/faq', [FaqController::class, 'index'])->name('user.faq');
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile-picture', [ProfilePictureController::class, 'update'])->name('profile.picture.update');

    // News Feed Routes
    Route::resource('news', NewsFeedController::class)->except(['destroy']);
    Route::post('/users/{user}/comments', [CommentController::class, 'storeComment'])->name('user.comments.store');
    Route::post('/news/{news}/comments', [CommentController::class, 'store'])->name('news.comments.store');
    Route::get('/news-feed/{newsId}', [MealOrderController::class, 'show'])->name('news.show');
    Route::get('/news-feed/{news}', [NewsFeedController::class, 'show'])->name('news-feed.show');
    Route::post('/news-feed/{newsId}/order', [MealOrderController::class, 'storeOrder'])->name('news.order');
});

// Admin Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin-dashboard', function () {
        if (Auth::user()->isAdmin) {
            return view('admin-dashboard'); // Only allow admins to view the admin dashboard
        }
        return redirect()->route('dashboard')->with('error', 'Access denied: Admins only.');
    })->name('admin.dashboard');

    // Admin News Feed Management
    Route::get('/admin/news-feed', [NewsFeedController::class, 'index'])->name('news_feed.news-feed');
    Route::get('/admin/create', [NewsFeedController::class, 'create'])->name('news_feed.create');
    Route::post('/news-feed', [NewsFeedController::class, 'store'])->name('news-feed.store');
    Route::get('/news-feed/{news}/edit', [NewsFeedController::class, 'edit'])->name('news-feed.edit');
    Route::put('/news-feed/{news}', [NewsFeedController::class, 'update'])->name('news-feed.update');
    Route::delete('/news-feed/{news}', [NewsFeedController::class, 'destroy'])->name('news-feed.destroy');

    // Admin User Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::patch('/users/{user}/toggle-admin', [UserController::class, 'toggleAdmin'])->name('users.toggleAdmin');

    // Admin FAQ Management
    Route::get('/admin/faq', [FaqController::class, 'admin'])->name('faq.admin');
    Route::get('/faq/create', [FaqController::class, 'create'])->name('faq.create');
    Route::post('/faq', [FaqController::class, 'store'])->name('faq.store');
    Route::get('/faq/{faq}/edit', [FaqController::class, 'edit'])->name('faq.edit');
    Route::put('/faq/{faq}', [FaqController::class, 'update'])->name('faq.update');
    Route::delete('/faq/{faq}', [FaqController::class, 'destroy'])->name('faq.destroy');

    // Admin Contact Management
    Route::get('/admin/contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('/admin/contacts/{contact}/reply', [ContactController::class, 'showReplyForm'])->name('admin.contacts.reply');
    Route::post('/admin/contacts/{contact}/reply', [ContactController::class, 'sendReply'])->name('admin.contacts.reply.send');

    // Admin Category Management
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
});

require __DIR__.'/auth.php';
