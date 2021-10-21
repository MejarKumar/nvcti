<?php

use App\Http\Controllers\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::group(['middleware'=>['auth:sanctum']], function () {
    Route::get('/show/{id}',[UserController::class, 'show']);
    Route::post('/logout',[UserController::class, 'logout']);

//event routing

 Route::get('/event/all_events',[EventController::class, 'index']);
Route::post('/event/create',[EventController::class, 'store']);
Route::get('/event/{id}',[EventController::class, 'showEvent']);
Route::put('/event/{id}/update',[EventController::class, 'update']);
Route::post('/event/{id}/delete',[EventController::class, 'delete']);
});



// Route::resource('event',EventController::class);
Route::post('/register',[UserController::class, 'register']);
Route::post('/login',[UserController::class, 'login']);
