<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Get all locations
 *
 * This endpoint returns all locations available in the database
 *
 * @responseField locations array with locations
 */
Route::get('locations', [\App\Http\Controllers\LocationController::class, 'index']);
