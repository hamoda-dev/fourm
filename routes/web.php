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

Route::resource('threads', ThreadController::class);

Route::controller(ReplyController::class)
    ->prefix('threads/{thread}/replies')
    ->as('replies.')
    ->group(function () {
        Route::post('/', 'store')->middleware('auth')->name('store');
    });

require __DIR__.'/auth.php';
