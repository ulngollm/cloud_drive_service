<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StorageController;
use App\Http\Middleware\CheckStorageAccess;
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

Route::get('/storages/types', [StorageController::class, 'getTypeList']);

Route::middleware(['auth:sanctum', CheckStorageAccess::class])->group(function () {
    Route::get('/storages/{storage}', [StorageController::class, 'getStorage']);
    Route::patch('/storages/{storage}', [StorageController::class, 'renameStorage']);
    Route::delete('/storages/{storage}', [StorageController::class, 'deleteStorage']);
    Route::get('/storages/{storage}/files', [StorageController::class, 'getFolderFiles']);
    Route::get('/storages/{storage}/file', [StorageController::class, 'getFile']);
    Route::get('/storages/{storage}/{type}', [StorageController::class, 'filterByType']);

});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/storages/', [StorageController::class, 'addStorage']);
    Route::get('/storages/', [StorageController::class, 'getList']);
});

Route::get('/token/create', AuthController::class);
Route::get('/login', function () {
    abort(403);
})->name('login');
