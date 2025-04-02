<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyRatingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Public routes
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');

// Authentication routes (provided by Laravel Breeze)
require __DIR__ . '/auth.php';

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Properties
    Route::get('/properties/my-properties', [PropertyController::class, 'myProperties'])->name('properties.my');
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
    Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::put('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');

    // Ratings
    Route::post('/properties/{property}/ratings', [PropertyRatingController::class, 'store'])->name('property.ratings.store');
    Route::delete('/ratings/{rating}', [PropertyRatingController::class, 'destroy'])->name('property.ratings.destroy');
});
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');


// Admin routes
Route::middleware(['auth', 'can:viewAny,App\Models\User'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', AdminUserController::class)->except(['show', 'create', 'store']);
    Route::resource('properties', AdminPropertyController::class)->except(['create', 'store']);
    Route::resource('features', FeatureController::class);
});
