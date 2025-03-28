<?php

use Illuminate\Support\Facades\Route;

// Public Routes - Bisa diakses tanpa login
Route::view('/', 'welcome'); // Contoh halaman awal

// Auth Routes (View Only)
Route::middleware('guest')->group(function () {
    Route::view('register', 'auth.register')->name('register');
    Route::view('login', 'auth.login')->name('login');
    Route::view('forgot-password', 'auth.forgot-password')->name('password.request');
    Route::view('reset-password/{token}', 'auth.reset-password')->name('password.reset');
});

// Routes yang membutuhkan login
Route::middleware('auth')->group(function () {
    Route::view('verify-email', 'auth.verify-email')->name('verification.notice');
    Route::view('confirm-password', 'auth.confirm-password')->name('password.confirm');
    Route::view('profile', 'profile.edit')->name('profile.edit');
    
    Route::view('/dashboard', 'dashboard')
        ->middleware(['verified', 'role:superAdmin|admin|guest'])
        ->name('dashboard');
});

// Public API/Features - Contoh route yang bisa diakses tanpa login
Route::view('/public/map', 'public.map-view')->name('public.map');
Route::view('/public/info', 'public.general-info')->name('public.info');
Route::view('/landing-page', 'landing')->name('landing');

// Jika ingin membuat route resource yang public
Route::view('/public/grounds', 'grounds.public-index')->name('grounds.public');