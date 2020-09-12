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

Route::get('/turmas', [App\Http\Controllers\TurmasController::class, 'index']);

Route::get('/turmas/{id}', [App\Http\Controllers\TurmasController::class, 'show']);

Route::post('/presenca', [App\Http\Controllers\PresencaController::class, 'store']);

Route::post('/presenca/aluno', [App\Http\Controllers\PresencaController::class, 'cadastraPresença']);

