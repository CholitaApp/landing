<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\WelcomeController;

Route::get('/', WelcomeController::class);
Route::post('subscribe', SubscribeController::class)->name('subscribe');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('subscribers', SubscriberController::class)->name('subscribers');
});

require __DIR__ . '/auth.php';
