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

/**
 * Get location by id
 *
 * This endpoint returns a location by its id
 *
 * @responseField locations array with locations
 *
 */
Route::get('locations/{id}', [\App\Http\Controllers\LocationController::class, 'show']);
