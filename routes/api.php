<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//ruta para crear usuarios
Route::post('users','UserController@store');
//ruta para loguearse
Route::post('login','UserController@login');


//autenticacion en la ruta directorios
Route::group(['middleware'=>'auth:api'],function(){
    Route::ApiResource('directorios','DirectorioController');
    Route::post('logout','UserController@logout');
});

