<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DescriptionController;
use App\Http\Controllers\GigController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UserController;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Support\Facades\Route;
use Barryvdh\Debugbar\Facades\Debugbar;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/gigs', function () {
    return 'gigs';
})->name('gigs');


Route::middleware('auth')->group(function() {
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/songs', SongController::class)->only(['create', 'update', 'destroy', 'store']);
        Route::resource('/albums', AlbumController::class)->only(['create', 'update', 'destroy', 'store']);
        Route::resource('/gigs', GigController::class)->only(['create', 'update', 'destroy', 'store']);
        Route::resource('/photos', PhotoController::class)->only(['create', 'update', 'destroy', 'store']);
        Route::get('/photos/manage', [PhotoController::class, 'manage'])->name('photos.manage');
        Route::resource('/description', DescriptionController::class)->only(['store', 'update']);
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    });
});

Route::resource('/albums', AlbumController::class)->only(['index', 'show']);
Route::resource('/songs', SongController::class)->only(['index']);
Route::resource('/photos', PhotoController::class)->only(['index']);
Route::resource('/gigs', GigController::class)->only(['index']);


Route::get('/login', [UserController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [UserController::class, 'authenticate'])->middleware('guest');
