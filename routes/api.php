<?php

use App\Http\Controllers\AuthController;
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

Route::post('/user', [AuthController::class, 'createUser']);
Route::delete('/user', [AuthController::class, 'deleteUser'])->middleware('auth:sanctum');
Route::get('/login', function () {
    abort(403);
})->name('login');
