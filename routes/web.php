<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserBlogController;
use Illuminate\Support\Facades\Route;

//----------Root Route----------------
Route::get('/', function () {
    return view('welcome');
});

//----------Home Route----------------
Route::get('/home', function () {
    return view('home');
})->name('home');

//----------Login and Register Routes----------------
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

//----------Middleware to handle routes for an authenticated user----------------
Route::middleware('auth')->group(function () {
    //----------User Logout--------------------
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    //----------User Home Route----------------
    Route::get('/user/home', fn() => view('user.homepage'))->name('user-home');
    //----------User Blog Routes----------------
    //Group User Blog CRUD Operations Routes and Forms
    //Use of prefix function with group function to list similar uri for routes
    Route::prefix('/user/blogs')
        ->scopeBindings()
        ->group(function () {
            Route::get('', [UserBlogController::class, 'index'])->name('user-blogs-index');
            Route::get('/create', [UserBlogController::class, 'create'])->name('user-blogs-create');
            Route::get('/{blog}', [UserBlogController::class, 'show'])->name('user-blogs-show');
            Route::post('', [UserBlogController::class, 'store'])->name('user-blogs-store');
            Route::get('/{blog}/edit', [UserBlogController::class, 'edit'])->name('user-blogs-edit');
            Route::put('/{blog}', [UserBlogController::class, 'update'])->name('user-blogs-update');
            Route::get('/{blog}/confirm-delete', [UserBlogController::class, 'confirmDelete'])->name('user-blogs-confirm-delete');
            Route::delete('/{blog}', [UserBlogController::class, 'destroy'])->name('user-blogs-delete');

            //----------Blog Section Routes----------------
            //Nested Section Routes under Blogs resource
            //Use of prefix function with group function list similar uri for routes
            Route::prefix('/{blog}/sections')->group(function () {
                Route::get('', [SectionController::class, 'index'])->name('sections-index');
                Route::get('/create', [SectionController::class, 'create'])->name('sections-create');
                Route::post('', [SectionController::class, 'store'])->name('sections-store');
                Route::get('/{section}', [SectionController::class, 'show'])->name('sections-show');
                Route::get('/{section}/edit', [SectionController::class, 'edit'])->name('sections-edit');
                Route::put('/{section}', [SectionController::class, 'update'])->name('sections-update');
                Route::get('/{section}/confirm-delete', [SectionController::class, 'confirmDelete'])->name('sections-confirm-delete');
                Route::delete('/{section}', [SectionController::class, 'destroy'])->name('sections-delete');
            });
        });
});

//----------Routes all Users can access----------------
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs-index');
Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs-show');