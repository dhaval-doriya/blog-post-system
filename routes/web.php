<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::check();
require __DIR__ . '/auth.php';


Route::get('/', function () {
    return redirect(route('blog.all'));
});


Route::middleware('auth')->group(function () {
    //dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('user.logout');
    Route::get('/change-password', [UserController::class, 'changePassword'])->name('password.change');
    Route::post('/change-password/{id}', [UserController::class, 'updatePassword'])->name('auth.password.change');

    //blog
    Route::resource('dashboard/blog', BlogController::class);
    Route::post('/check-slug', [BlogController::class, 'blogSlugCheck'])->name('blog.slug');
    Route::post('/check-description', [BlogController::class, 'checkDescription'])->name('blog.description');
    //user route
    Route::group(['prefix' => 'user'], function () {
        Route::get('/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::put('/update/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
        Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
        Route::put('/photo/{id}', [UserController::class, 'profilePic'])->name('profile.edit');
        Route::delete('/photo/{id}', [UserController::class, 'deleteProfilePic'])->name('profile.remove');
    });

    //category routes
    Route::middleware('isAdmin')->group(function () {
        //Update Status
        Route::patch('/blog/{id}', [BlogController::class, 'status'])->name('approve.blog');
        Route::patch('/category/{id}', [CategoryController::class, 'status'])->name('manage.category');
        Route::patch('/user/{id}', [UserController::class, 'status'])->name('manage.user');

        // category routes
        Route::group(['prefix' => 'dashboard'], function () {
            Route::resource('category', CategoryController::class);
            Route::post('/check-slug', [CategoryController::class, 'categorySlugCheck'])->name('category.slug');

            //user route
            Route::group(['prefix' => 'user'], function () {
                Route::get('/', [UserController::class, 'index'])->name('user.index');
                Route::get('/create', [UserController::class, 'create'])->name('user.create');
                Route::post('/create', [UserController::class, 'store'])->name('user.store');
            });
        });
    });
});

// for viewers
Route::group(['prefix' => 'home'], function () {
    Route::get('/', [HomeController::class, 'blogs'])->name('blog.all');
    Route::get('/blog/{slug}', [HomeController::class, 'blog'])->name('blog.one');
    Route::get('/cat/{slug}', [HomeController::class, 'category'])->name('category.all');
    Route::get('/user/{id}', [HomeController::class, 'blogsByUser'])->name('blog.user');
});
