<?php

use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class);
Route::post('subscribe', SubscribeController::class)->name('subscribe');
