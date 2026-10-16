<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Middleware\AdminOnly;
use Illuminate\Support\Facades\Route;

Route::get('/sitemap.xml', [PageController::class, 'sitemap']);
Route::get('/robots.txt', [PageController::class, 'robots']);

// Admin panel: read the messages customers send from the contact form.
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'loginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->middleware('throttle:5,1');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    Route::middleware(AdminOnly::class)->group(function () {
        Route::get('/', [AdminController::class, 'messages'])->name('messages');
        Route::get('/password', [AdminController::class, 'passwordForm'])->name('password');
        Route::post('/password', [AdminController::class, 'updatePassword']);
        Route::post('/messages/{message}/done', [AdminController::class, 'toggleDone'])->name('done');
        Route::delete('/messages/{message}', [AdminController::class, 'destroy'])->name('delete');
    });
});

// Every other non-API URL loads the Vue app; vue-router decides which page to show.
Route::get('/{any?}', [PageController::class, 'show'])->where('any', '^(?!api/|admin|up$|storage/).*$');
