<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserHomeController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'user-type:admin'])->group(function () {
  
        return view('welcome'); // Replace 'welcome' with the actual view for the admin

});

Route::middleware(['auth', 'user-type:superadmin'])->group(function () {
  
        return view('welcome');
});

Route::middleware(['auth', 'user-type:user'])->group(function () {

        return view('user_home'); // Replace 'user_home' with the actual view for the user

});
Route::get('/get-users', [HomeController::class, 'getUsers'])->name('get.users');
Route::get('/user-details/{userId}', [UserHomeController::class, 'getUserDetails']);
Route::post('/deactivate-user/{id}', [UserHomeController::class, 'deactivateUser'])->name('deactivate.user');
Route::post('/activate-user/{id}', [UserHomeController::class, 'activateUser'])->name('activate.user');
Route::post('/update-user/{id}', [UserHomeController::class, 'updateUser'])->name('update.user');