<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\pacientes;
use App\Http\Controllers\post; 


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

Route::middleware('auth:api')->get('user',              [AuthController::class,'user']);
Route::middleware('auth:api')->post('logout',           [AuthController::class,'logout']);
Route::middleware('auth:api')->get('pacientes',         [pacientes::class,'index']);
Route::middleware('auth:api')->post('pacientesCreate',  [pacientes::class,'store']);
Route::middleware('auth:api')->get('pacientesShow',     [pacientes::class,'show']);
Route::middleware('auth:api')->put('pacientesUpdate',   [pacientes::class,'update']);
Route::middleware('auth:api')->get('pacientesDelete',   [pacientes::class,'destroy']);
Route::middleware('auth:api')->post('post',             [post::class,'index']);
Route::middleware('auth:api')->get('postCreate',        [post::class,'store']);
Route::middleware('auth:api')->get('postShow',          [post::class,'show']);
Route::middleware('auth:api')->put('postUpdate',        [post::class,'update']);
Route::middleware('auth:api')->get('postDelete',        [post::class,'destroy']);



Route::prefix('auth')->group(function(){
    Route::post('login',        [AuthController::class,'login']);
    Route::post('signup',       [AuthController::class,'signup']);
});
