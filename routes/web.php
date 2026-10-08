<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/sitemap.xml', [PageController::class, 'sitemap']);
Route::get('/robots.txt', [PageController::class, 'robots']);

// Every other non-API URL loads the Vue app; vue-router decides which page to show.
Route::get('/{any?}', [PageController::class, 'show'])->where('any', '^(?!api/|up$|storage/).*$');
