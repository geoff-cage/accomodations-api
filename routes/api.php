<?php

use App\Http\Controllers\AccomodationController;
use App\Http\Controllers\InstitutionController;
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

Route::get('/institutions', [InstitutionController::class, 'index']);
Route::post('/institutions/create', [InstitutionController::class, 'create']);
Route::post('/institutions', [InstitutionController::class, 'store']); // this is no longer needed right?
Route::get('/institutions/{id}', [InstitutionController::class, 'show']);
Route::post('/institutions/update{id}', [InstitutionController::class, 'update']);
Route::get('/institutions/search/{name}', [InstitutionController::class, 'search']);
Route::get('/institutions/delete{id}', [InstitutionController::class, 'delete']);