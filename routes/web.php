<?php

use App\Http\Controllers\DiscussionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

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

Auth::routes();

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    //Adminstrator Routes
    Route::get('users/', [UsersController::class, 'index'])->name('users.list');
    Route::get('discussions/unapproved', [DiscussionsController::class, 'unapproved'])->name('pending-notices');
    Route::post('discussions/{discussion}/approve', 'App\Http\Controllers\DiscussionsController@approve')
    ->name('approve-notice');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('discussions', App\Http\Controllers\DiscussionsController::class);

Route::resource('discussions/{discussion}/replies', App\Http\Controllers\RepliesController::class);

Route::get('users/notifications', [UsersController::class, 'notifications'])->name('users.notifications');