<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;

use App\Enums\RoleEnum;
use App\Livewire\AddToCart;
use App\Application\CartApplication;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin',
])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })
            ->name('dashboard');
    });

Route::middleware([])
    ->group(function () {
        Route::get('/', [PagesController::class, 'home'])
            ->name('landing_page');
        Route::get('/home', [PagesController::class, 'home'])
            ->name('home_page');
        Route::prefix('category')->group(function () {
            Route::get('/', [PagesController::class, 'category'])
                ->name('category_page');
            Route::get('/{categorySlug?}product', [ProductController::class, 'index'])
                ->where('categorySlug', '[a-zA-Z0-9-]*')
                ->name('product_page');
        });

        Route::get('/product/{productSlug}', [ProductController::class, 'show'])
            ->name('product_detail_page');
    });

