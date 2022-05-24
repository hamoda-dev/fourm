<?php

use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ThreadController;
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

Route::controller(ReplyController::class)
    ->prefix('threads/{thread}/replies')
    ->as('replies.')
    ->group(function () {
        Route::post('/', 'store')->name('store');
    });

require __DIR__.'/auth.php';
