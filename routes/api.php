<?php

use App\Http\Controllers\StorageController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::patch('/storages/{id}', [StorageController::class, 'renameStorage']);
Route::delete('/storages/{id}', [StorageController::class, 'deleteStorage']);
Route::post('/storages/', [StorageController::class, 'addStorage']);
Route::get('/storages/', [StorageController::class, 'getList']);

Route::get('/storages/{id}/files', [StorageController::class, 'getFolderFiles']);
