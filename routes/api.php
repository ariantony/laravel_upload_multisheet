<?php

use App\Http\Controllers\CollectionImportController;
use App\Http\Controllers\ExcelImportController;
use App\Http\Controllers\ExportUserController;
use App\Http\Controllers\KomponenGajiController;
use App\Http\Controllers\TanggalController;
use App\Http\Controllers\TemplateController;
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

Route::get('/test',[TestController::class,'index']);
Route::get('/test1',[TestController::class,'test']);
Route::get('/test2',[TestController::class,'test2']);
Route::get('/test3',[TestController::class,'test3']);

// Route::get('/users/import',[UsersImportController::class],'show');
Route::post('/users/import',[UsersImportController::class,'store']);

Route::post('/collection',[ExcelImportController::class,'excel']);
Route::post('/koleksi',[ExcelImportController::class,'ImportExcel']);
Route::get('/kol',[ExcelImportController::class,'TestCollection']);

Route::get('/tanggal',[TanggalController::class,'index']);
Route::post('/date',[TanggalController::class,'ImportExcel']);

Route::get('/export',[ExportUserController::class,'index']);

Route::get('/komponen-gaji',[KomponenGajiController::class,'index']);

Route::get('/template',[TemplateController::class,'index']);
