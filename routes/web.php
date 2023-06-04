<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController,InstitutionController, AccomodationController,RoomController,ReservationController,
PagesController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Route::get('/', function () {
 *   return view('welcome');
 * }); 
 */


Route::get('/', [PagesController::class, 'index']);
Route::get('/loginin', [PagesController::class, 'loginin']);
Route::get('/registering', [PagesController::class, 'registering']);


Route::middleware(['admin'])->group(function(){
    Route::post('/logout', [AuthController::class, 'logout']);
});

//auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


//institution
Route::get('/institutions', [InstitutionController::class, 'index']);
Route::post('/institutions/create', [InstitutionController::class, 'create']);
Route::get('/institutions/{id}', [InstitutionController::class, 'show']);
Route::post('/institutions/update/{id}', [InstitutionController::class, 'update']);
Route::get('/institutions/search/{name}', [InstitutionController::class, 'search']);
Route::get('/institutions/destroy/{id}', [InstitutionController::class, 'destroy']);
Route::get('/institutions/{institution_id}/accomodations', [InstitutionController::class, 'getAccomodations']);

//accomodations
Route::get('/accomodations', [AccomodationController::class, 'index']);
Route::post('/accomodations/create', [AccomodationController::class, 'create']);
Route::get('/accomodations/{id}', [AccomodationController::class, 'show']);
Route::post('/accomodations/update/{id}', [AccomodationController::class, 'update']);
Route::get('/accomodations/search/{name}', [AccomodationController::class, 'search']);
Route::get('/accomodations/destroy/{id}', [AccomodationController::class, 'destroy']);
Route::get('/accomodations/{accomodation_id}/rooms', [AccomodationController::class, 'getRooms']);

//rooms
Route::get('/rooms', [RoomController::class, 'index']);
Route::post('/rooms/create', [RoomController::class, 'create']);
Route::get('/rooms/{id}', [RoomController::class, 'show']);
Route::post('/rooms/update/{id}', [RoomController::class, 'update']);
Route::get('/rooms/search/{name}', [RoomController::class, 'search']);
Route::get('/rooms/delete/{id}', [RoomController::class, 'delete']);
Route::get('/rooms/{room_id}/reservations', [RoomController::class, 'getReservations']);

//reservation
Route::get('/reservations', [ReservationController::class, 'index']);
Route::post('/reservations/create', [ReservationController::class, 'store']);
Route::get('/reservations/{id}', [ReservationController::class, 'show']);
Route::post('/reservations/update/{id}', [ReservationController::class, 'update']);
Route::get('/reservations/search/{name}', [ReservationController::class, 'search']);
Route::get('/reservations/delete/{id}', [ReservationController::class, 'destroy']);