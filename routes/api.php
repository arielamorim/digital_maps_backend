<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Get all locations
 *
 * This endpoint returns all locations available in the database
 */
Route::get('locations', [\App\Http\Controllers\LocationController::class, 'index']);

/**
 * Get location by id
 *
 * This endpoint returns a location by its id
 *
 */
Route::get('locations/{id}', [\App\Http\Controllers\LocationController::class, 'show']);

/**
 * Create new location
 */
Route::post('locations', [\App\Http\Controllers\LocationController::class, 'store']);

/**
 * Update location
 */
Route::put('locations/{id}', [\App\Http\Controllers\LocationController::class, 'update']);

/**
 * Delete location
 */
Route::delete('locations/{id}', [\App\Http\Controllers\LocationController::class, 'destroy']);

/**
 * Show locations by proximity
 *
 * This endpoint shows locations by proximity and their open status
 */
Route::get('proximity/locations', [\App\Http\Controllers\LocationController::class, 'proximity']);
