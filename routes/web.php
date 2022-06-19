<?php

use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(ThreadController::class)
    ->prefix('channels/{channel}/threads')
    ->as('threads.')
    ->group(function () {
        Route::get('{thread}', 'show')->name('show');
    });

Route::resource('threads', ThreadController::class)
    ->except(['show']);
Route::controller(ThreadController::class)
    ->prefix('threads')
    ->as('threads.')
    ->group(function () {
        Route::get('{channel}', 'index')->name('channel');
    });

Route::controller(ReplyController::class)
    ->prefix('threads/{thread}/replies')
    ->as('replies.')
    ->group(function () {
        Route::post('/', 'store')->name('store');
    });

Route::controller(FavoriteController::class)
    ->prefix('favorites')
    ->as('favorites.')
    ->group(function () {
        Route::post('{reply}', 'store')->name('reply');
    });

Route::controller(ProfileController::class)
    ->prefix('profiles')
    ->as('profiles.')
    ->group(function () {
        Route::get('{user:username}', 'show')->name('show');
    });

require __DIR__.'/auth.php';
