<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TempFileController;
use App\Http\Controllers\VideoController;

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

//Video Routes
Route::get( '/video/{id}', [ VideoController::class, 'downloadOriginal' ] );

Route::get( '/reduced_video/{id}', [ VideoController::class, 'downloadReduced' ] );

//TempFile Routes
Route::post( '/upload', [ TempFileController::class, 'store' ] )->name( 'upload_temp' );

Route::delete( '/delete/{folder}', [ TempFileController::class , 'delete' ] )->name( 'delete_temp' );