<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\PricingController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{slug}', [ServiceController::class, 'show']);
Route::get('/pricing', [PricingController::class, 'index']);
Route::get('/projects', [ProjectController::class, 'index']);

// 5 enquiries per minute per IP keeps spam bots out of the table.
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1');
