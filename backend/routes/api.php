<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MelonController; 

Route::get('/melons', [MelonController::class, 'index']);
Route::post('/melons', [MelonController::class, 'store']);