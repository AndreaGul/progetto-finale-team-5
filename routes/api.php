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

//http://127.0.0.1:8000/api/professionals/?specialization_id=&vote=&review=
Route::get('professionals', [ProfessionalController::class, 'index']);

//http://127.0.0.1:8000/api/professionals/show/1
//http://127.0.0.1:8000/api/professionals/show/slug
Route::get('professionals/show/{id}', [ProfessionalController::class, 'show']);

//http://127.0.0.1:8000/api/professionals/message
Route::post('professionals/message', [ProfessionalController::class, 'addMessage']);

//http://127.0.0.1:8000/api/professionals/review
Route::post('professionals/review', [ProfessionalController::class, 'addReview']);

//http://127.0.0.1:8000/api/professionals/vote
Route::post('professionals/vote', [ProfessionalController::class, 'addVote']);

//http://127.0.0.1:8000/api/professionals/sponsored
Route::get('professionals/sponsored', [ProfessionalController::class, 'sponsored']);

//http://127.0.0.1:8000/api/specializations
Route::get('specializations', [SpecializationController::class, 'index']);
