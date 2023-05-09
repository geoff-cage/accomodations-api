<?php

use App\Http\Controllers\{AuthController,InstitutionController, AccomodationController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//protected routes
Route::middleware('auth:sanctum')->group( function () {
    Route::post('/logout', [AuthController::class, 'logout']);   
    
    
});

//
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


//institution
Route::get('/institutions', [InstitutionController::class, 'index']);
Route::post('/institutions/create', [InstitutionController::class, 'create']);
Route::get('/institutions/{id}', [InstitutionController::class, 'show']);
Route::post('/institutions/update/{id}', [InstitutionController::class, 'update']);
Route::get('/institutions/search/{name}', [InstitutionController::class, 'search']);
Route::get('/institutions/destroy/{id}', [InstitutionController::class, 'destroy']);

//accomodations
Route::get('/accomodations', [AccomoddationController::class, 'index']);