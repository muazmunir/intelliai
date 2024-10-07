<?php

use App\Http\Controllers\Admin\FeautreController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->name('frontend.')->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/services', 'services')->name('services');
    Route::get('/contact', 'contact')->name('contact');
});

require __DIR__.'/auth.php';

Route::macro('CustomResource', function ($url, $controller) {
    Route::controller($controller)->prefix($url)->name($url)->group(function () {
        Route::get('/dataTable', 'dataTable')->name('.dataTable');
    });
    Route::resource($url, $controller);
});

Route::macro('IndexOrUpdate', function ($url, $controller) {
    Route::controller($controller)->prefix($url)->name($url)->group(function () {
        Route::get('/', 'index');
        Route::match(['put', 'patch'], '/update', 'update')->name('.update');
    });
});

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'adminIndex'])->name('admin.dashboard')->middleware('verified', 'user-access:admin');
    Route::controller(ProfileController::class)->prefix('profile')->name('profile')->group(function () {
        Route::get('edit', 'edit')->name('.edit');
        Route::patch('update', 'update')->name('.update');
        Route::delete('destroy', 'destroy')->name('.destroy');
    });
});

Route::middleware(['auth', 'verified', 'user-access:admin'])->prefix('admin')->group(function () {
    Route::CustomResource('users', UserController::class);
    Route::IndexOrUpdate('setting', SettingController::class);
    Route::CustomResource('service-categories', ServiceCategoryController::class);
    Route::CustomResource('services', ServiceController::class);
    Route::CustomResource('features', FeautreController::class);
});
