<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\userController;
use App\Http\Controllers\booksController;
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

// Route::get('/', function () {
//     return view('Dashboard.dashboard');
// });


Route::group(['middleware'  => 'guest'], function(){
    Route::get('/', [authController::class, 'loginForm'])->name('login');
    Route::get('/register', [authController::class, 'registerForm']);
});

Route::group(['middleware' => 'auth'], function(){
    // Get
    Route::get('/dashboard', [adminController::class, 'index']);
    Route::get('/profile/{user:username}', [adminController::class, 'profile']);
    Route::get('/books', [booksController::class, 'index']);
    Route::get('/delete/{id}', [booksController::class, 'destroy']);

    // Post
    Route::post('/update-profile/{id}', [userController::class, 'update']);
});

Route::post('/login', [authController::class, 'login']);
Route::post('/register', [authController::class, 'register']);
Route::get('/logout', [authController::class, 'logout']);