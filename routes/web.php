<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserBlogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/user/home', fn() => view('user.homepage'));
    //Group User Blog CRUD Operations Routes
    Route::prefix('/user/blogs')->group(function () {
        Route::get('', [UserBlogController::class, 'index'])->name('user-blogs-index');
        Route::get('/create', [UserBlogController::class, 'create'])->name('user-blogs-create');
        Route::get('/{id}', [UserBlogController::class, 'show'])->name('user-blogs-show');
        Route::post('', [UserBlogController::class, 'store'])->name('user-blogs-store');
        Route::get('/{id}/edit', [UserBlogController::class, 'edit'])->name('user-blogs-edit');
        Route::put('/{id}', [UserBlogController::class, 'update'])->name('user-blogs-update');
        Route::delete('/{id}', [UserBlogController::class, 'delete']);
    });
});

// Route::get('/user/home', function () {
//     return view('user.homepage');
// })->name('user.homepage');

Route::get('/blogs', [BlogController::class, 'index'])->name('blogs-index');
Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs-create');
Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs-show');