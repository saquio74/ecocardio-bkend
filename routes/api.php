<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\pacientesController;
use App\Http\Controllers\postController; 


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
Route::middleware('auth:api')->get('pacientes',         [pacientesController::class,'index']);
Route::middleware('auth:api')->post('pacientesCreate',  [pacientesController::class,'store']);
Route::middleware('auth:api')->get('pacientesShow',     [pacientesController::class,'show']);
Route::middleware('auth:api')->put('pacientesUpdate',   [pacientesController::class,'update']);
Route::middleware('auth:api')->delete('pacientesDelete',[pacientesController::class,'destroy']);
Route::get('post',                                      [postController::class,'index']);
Route::middleware('auth:api')->post('postCreate',       [postController::class,'store']);
Route::get('postShow/{id}',                             [postController::class,'show']);
Route::middleware('auth:api')->put('postUpdate',        [postController::class,'update']);
Route::middleware('auth:api')->delete('postDelete',     [postController::class,'destroy']);




Route::prefix('auth')->group(function(){
    Route::post('login',        [AuthController::class,'login']);
    Route::post('signup',       [AuthController::class,'signup']);
});
