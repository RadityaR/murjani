<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes (assuming you're using Laravel's built-in auth)
Auth::routes();

// Home routes
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/blank', [HomeController::class, 'blank'])->name('blank');

// Routes that require authentication
Route::middleware(['auth'])->group(function () {
    // Employee routes
    Route::resource('employees', EmployeeController::class);
    
    // Custom route for uploading employee documents
    Route::get('employees/{employee}/upload-document', [EmployeeController::class, 'showUploadForm'])->name('employees.upload-document');
    Route::post('employees/{employee}/upload-document', [EmployeeController::class, 'uploadDocument'])->name('employees.upload-document.store');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    
    // File upload routes
    Route::resource('files', FileUploadController::class);
    
    // User management routes (admin only)
    Route::middleware(['admin'])->group(function () {
        Route::resource('users', UserController::class);
    });
});

// Example routes for demonstration purposes
Route::get('/examples/blank', [ExampleController::class, 'blank'])->name('examples.blank');
Route::get('/examples/form', [ExampleController::class, 'form'])->name('examples.form');
Route::get('/examples/chart', [ExampleController::class, 'chart'])->name('examples.chart');
Route::get('/examples/table', [ExampleController::class, 'table'])->name('examples.table');
