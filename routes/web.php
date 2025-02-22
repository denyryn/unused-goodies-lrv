<?php

use Illuminate\Support\Facades\Route;
use App\Enums\RoleEnum;
use App\Http\Controllers\HomePage;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/landing', [HomePage::class, 'index'])->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->name('landing');
