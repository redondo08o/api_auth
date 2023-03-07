<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\CursoController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;

route::post('register', [AuthController::class, 'register']);
route::post('login', [AuthController::class, 'login'])->name('login');
route::get('profile', [AuthController::class, 'userProfile']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('user_profile', [AuthController::class, 'userProfile']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('/cursos', [CursoController::class, 'index']);
    Route::post('/cursos', [CursoController::class, 'store']);
    Route::put('/cursos/{id}', [CursoController::class, 'update']);
    Route::delete('/cursos/{id}', [CursoController::class, 'destroy']);
});
