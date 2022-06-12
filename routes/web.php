<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function (){
   return view('docs', [
       'swaggerHubUrl' => 'https://api.swaggerhub.com/apis/ulngollm/lms_disk_api/1.0.3'
   ]);
});
Route::get('/storages/list/{user}', [\App\Http\Controllers\DemoStorageController::class, 'storages']);
Route::get('/storages/{storage}', [\App\Http\Controllers\DemoStorageController::class, 'index']);
