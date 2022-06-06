<?php

use App\Models\book;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\userController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\booksController;
use App\Http\Controllers\Tripay\RequestController;

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
    Route::post('/login', [authController::class, 'login']);
    Route::post('/register', [authController::class, 'register']);
    Route::get('/try', [authController::class, 'Request']);
});

Route::post('/borrow/{id}', [booksController::class, 'borrow']);

Route::group(['middleware' => 'auth'], function(){

Route::group(['middleware' => 'admin'], function(){
        Route::get('/books', [booksController::class, 'index']);
        Route::get('/students', [adminController::class, 'studentslist']);
        Route::get('/dashboard', [adminController::class, 'index']);
        Route::get('/delete/{id}', [booksController::class, 'destroy']);
        Route::get('/addbook', [booksController::class, 'add']);
        Route::get('/editbook/{id}', [booksController::class, 'edit']);
        Route::get('/message', [adminController::class, 'message']);
        Route::get('/confirm/{id}', [adminController::class, 'confirm']);
        Route::get('/deleteconfirm/{id}', [adminController::class, 'deleteC']);
        Route::get('/destroyAll', [adminController::class, 'destroyAll']);
        Route::get('/return', [adminController::class, 'returnBook']);
        Route::get('/returnBook/{id}', [adminController::class, 'returnBook1']);
        Route::get('/deleteUser/{id}', [adminController::class, 'destroy']);

        Route::post('/uploadbook', [booksController::class, 'store']);
        Route::post('/updatebook/{id}', [booksController::class, 'update']);
    });

    // Get
    Route::get('/profile/{user:username}', [adminController::class, 'profile']);
    Route::get('/home', [userController::class, 'index']);
    Route::get('/book/{id}', [userController::class, 'showe']);
    Route::get('/addFavorite/{id}', [booksController::class, 'addF']);
    Route::get('/dropFavorite/{id}', [booksController::class, 'dropF']);

    
    Route::get('/logout', [authController::class, 'logout']);

    // Post
    Route::post('/update-profile/{id}', [userController::class, 'update']);
    Route::get('/Book-list/{bookshelf:nameBookshelf}', [userController::class, 'showBook']);
    Route::get('/favoriteBook', [userController::class, 'showFavorite']);
});








// Route::post('/borrow/{$id}', [authController::class, 'borrow']);
