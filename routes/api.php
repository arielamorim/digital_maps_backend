<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('locations', [\App\Http\Controllers\LocationController::class, 'index']);
