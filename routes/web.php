<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VideoController;

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

//Home Routes
Route::get( '/', [ HomeController::class, 'show' ] )->name( 'home' );

//Video Routes
Route::get( '/search/{value}', [ VideoController::class, 'search' ] )->name( 'search_video' );

Route::view( '/addVideo', 'uploadVideo' );

Route::get( '/display/{id}', [ VideoController::class, 'show' ] )->name( 'display_video' );

Route::post( '/videos', [ VideoController::class, 'storeVideos' ] )->name( 'store_video' );

Route::post( '/import', [ VideoController::class, 'importVideos' ] )->name( 'import_videos' );