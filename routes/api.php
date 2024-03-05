<?php

use App\Http\Controllers\Api\ProfessionalController;
use App\Http\Controllers\Api\SpecializationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('professionals', [ProfessionalController::class, 'index']);

Route::get('specializations', [SpecializationController::class, 'index']);

// Route::get('projects/{slug}', [ProjectController::class, 'show']);
