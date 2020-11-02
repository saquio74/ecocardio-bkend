<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\PostController; 
use App\Http\Controllers\ComentariosController; 


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

Route::middleware('auth:api')->get('user',                      [AuthController::class,'user']);
Route::middleware('auth:api')->post('logout',                   [AuthController::class,'logout']);
Route::middleware('auth:api')->get('pacientes',                 [PacientesController::class,'index']);
Route::middleware('auth:api')->post('pacientesCreate',          [PacientesController::class,'store']);
Route::middleware('auth:api')->get('pacientesShow',             [PacientesController::class,'show']);
Route::middleware('auth:api')->put('pacientesUpdate',           [PacientesController::class,'update']);
Route::middleware('auth:api')->delete('pacientesDelete',        [PacientesController::class,'destroy']);
Route::get('post',                                              [PostController::class,'index']);
Route::middleware('auth:api')->post('postCreate',               [PostController::class,'store']);
Route::get('postShow/{id}',                                     [PostController::class,'show']);
Route::get('myPosts/{id}',                                      [PostController::class,'myPosts']);
Route::middleware('auth:api')->post('postUpdate',               [PostController::class,'update']);
Route::middleware('auth:api')->delete('postDelete/{id}',        [PostController::class,'destroy']);
Route::get('comentarios/{id}',                                  [ComentariosController::class,'index']);
Route::middleware('auth:api')->post('comentarioCreate',         [ComentariosController::class,'store']);
Route::get('comentarioShow/{id}',                               [ComentariosController::class,'show']);
Route::get('mycomentarios/{id}',                                [ComentariosController::class,'myPosts']);
Route::middleware('auth:api')->post('comentarioUpdate',         [ComentariosController::class,'update']);
Route::middleware('auth:api')->delete('comentarioDelete/{id}',  [ComentariosController::class,'destroy']);


Route::group(['middleware' => ['web']], function () {
    Route::get('login/{website}',                           [AuthController::class, 'redirectToProvider']);
    Route::get('login/{website}/callback',                  [AuthController::class, 'handlerProviderCallback']);
});



Route::prefix('auth')->group(function(){
    Route::post('login',        [AuthController::class,'login']);
    Route::post('signup',       [AuthController::class,'signup']);
});
