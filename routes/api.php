<?php

use App\Http\Controllers\CollectionImportController;
use App\Http\Controllers\ExcelImportController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UsersImportController;
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

Route::get('/',[TestController::class,'index']);

// Route::get('/users/import',[UsersImportController::class],'show');
Route::post('/users/import',[UsersImportController::class,'store']);

Route::post('/collection',[ExcelImportController::class,'excel']);
Route::post('/koleksi',[ExcelImportController::class,'ImportExcel']);
Route::get('/kol',[ExcelImportController::class,'TestCollection']);
