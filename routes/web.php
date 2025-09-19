<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SocialAuthController;

Route::get('/', function () {
    return view('home');
});

// Show login form
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Handle login submit
Route::post('/login', [LoginController::class, 'login']);

// Forgot Password Form
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

// Handle Forgot Password (dummy for now)
Route::post('/forgot-password', function () {
    return 'Password reset link sent!';
})->name('password.email');

// Show Register Form
Route::get('/register', function () {
    return view('auth.register'); // create this view later
})->name('register');

// Handle Register Submit (dummy)
Route::post('/register', function () {
    return 'Register submitted!';
});

Route::get('/', function () {
    return view('landing');
});

Route::view('/', 'landing')->name('landing');
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

// Dummy password reset route (remove when using Breeze/Jetstream)
Route::get('/forgot-password', function () {
    return 'Password reset page here';
})->name('password.request');


Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

Route::get('/auth/facebook', [SocialAuthController::class, 'redirectToFacebook']);
Route::get('/auth/facebook/callback', [SocialAuthController::class, 'handleFacebookCallback']);





