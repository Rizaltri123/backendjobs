<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JobListingController;
use App\Http\Controllers\Api\CompanyPictureController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApplyFormController;

/**
 * Route Public (tanpa token API, bebas diakses)
 */
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


/**
 * Route untuk Client API yang terdaftar (diverifikasi dengan token API)
 */
Route::middleware('api.token')->group(function () {
    Route::get('/jobs', [JobListingController::class, 'index']);
    Route::get('/jobs/{id}', [JobListingController::class, 'show']);
    Route::post('/jobs', [JobListingController::class, 'store']);
    Route::put('/jobs/{id}', [JobListingController::class, 'update']);
    Route::delete('/jobs/{id}', [JobListingController::class, 'destroy']);
    Route::get('/companies', [CompanyPictureController::class, 'index']);
    Route::post('/apply-form', [ApplyFormController::class, 'store']);
    Route::get('/applicants', [ApplyFormController::class, 'index']);
    Route::get('/applicants/{id}', [ApplyFormController::class, 'show']);

    // Route dengan auth Sanctum di dalam verify.api.client
    Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'profile']);
});

