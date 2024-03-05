<?php

use App\Http\Controllers\Api\ProfessionalController;
use App\Http\Controllers\Api\SpecializationController;
use App\Http\Controllers\Api\SponsorizationController;
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

//http://127.0.0.1:8000/api/professionals/1,4
Route::get('professionals/{id}', [ProfessionalController::class, 'index']);

//http://127.0.0.1:8000/api/specializations
Route::get('specializations', [SpecializationController::class, 'index']);


// Route::get('projects/{slug}', [ProjectController::class, 'show']);
