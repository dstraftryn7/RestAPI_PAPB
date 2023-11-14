<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\TaskController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
use App\Http\Controllers\UserController;

// Mendapatkan data pengguna
Route::get('/user', [AuthController::class, 'getUser']);

// Menyimpan data pengguna
Route::put('/user', [AuthController::class, 'updateUser']);

Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/tasks', [TaskController::class, 'index']);
Route::post('/tasks-create', [TaskController::class, 'store']);
Route::get('/users',  [AuthController::class, 'profile']);
Route::apiResource('/boards', BoardController::class);
Route::delete('/boards/{id}', 'BoardController@destroy');


// Route::group(['middleware' => ['auth:sanctum']], function() {
//     Route::post('/logout', [AuthController::class, 'logout']);
//     Route::get('/tasks', [TaskController::class, 'index']);
//     Route::post('/tasks-create', [TaskController::class, 'store']);
//     Route::get('/users',  [AuthController::class, 'profile']);
//     Route::apiResource('/boards', BoardController::class);
// });

