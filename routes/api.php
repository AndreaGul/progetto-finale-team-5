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

//http://127.0.0.1:8000/api/user
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return '$request->user()';
});

//http://127.0.0.1:8000/api/professionals/1,4
Route::get('professionals/{id}', [ProfessionalController::class, 'index']);

//http://127.0.0.1:8000/api/professionals/show/1
Route::get('professionals/show/{id}', [ProfessionalController::class, 'show']);

//http://127.0.0.1:8000/api/professionals/message
Route::post('professionals/message', [ProfessionalController::class, 'addMessage']);

//http://127.0.0.1:8000/api/professionals/review
Route::post('professionals/review', [ProfessionalController::class, 'addReview']);

//http://127.0.0.1:8000/api/specializations
Route::get('specializations', [SpecializationController::class, 'index']);


/*
use Illuminate\Support\Facades\Auth;


Route::get('/userLoggedIn', function (Request $request) {
    return response()->json([
        'loggedIn' => Auth::check()
    ]);
});
*/
