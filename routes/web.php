<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FileUploadController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

// All authenticated routes
Route::middleware(['auth'])->group(function () {
    // Debug routes
    Route::get('/debug-role', function() {
        if (auth()->check()) {
            dd([
                'is_logged_in' => true,
                'user' => auth()->user(),
                'role' => auth()->user()->role,
                'is_admin' => auth()->user()->isAdmin(),
            ]);
        } else {
            dd([
                'is_logged_in' => false,
                'message' => 'User is not logged in'
            ]);
        }
    });

    Route::get('/debug-users', function() {
        dd([
            'all_users' => \App\Models\User::all()->map(function($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'nip' => $user->nip,
                    'role' => $user->role,
                ];
            }),
            'admin_users' => \App\Models\User::where('role', 'admin')->get()->map(function($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'nip' => $user->nip,
                    'role' => $user->role,
                ];
            }),
        ]);
    });

    // Basic routes
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/blank-page', [HomeController::class, 'blank'])->name('blank');

    // Profile routes
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change-password', [ProfileController::class, 'changepassword'])->name('profile.change-password');
    Route::put('/profile/password', [ProfileController::class, 'password'])->name('profile.password');

    // Admin only routes
    Route::middleware('admin')->group(function () {
        // User management
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        
        // File validation routes
        Route::get('/files', [FileUploadController::class, 'index'])->name('files.index');
        Route::put('/files/{file}/validate', [FileUploadController::class, 'validateFile'])->name('files.validate');
        Route::delete('/files/{file}', [FileUploadController::class, 'destroy'])->name('files.destroy');
    });

    // Superadmin routes
    Route::middleware(['superadmin'])->group(function () {
        Route::get('/hakakses', [App\Http\Controllers\HakaksesController::class, 'index'])->name('hakakses.index');
        Route::get('/hakakses/edit/{id}', [App\Http\Controllers\HakaksesController::class, 'edit'])->name('hakakses.edit');
        Route::put('/hakakses/update/{id}', [App\Http\Controllers\HakaksesController::class, 'update'])->name('hakakses.update');
        Route::delete('/hakakses/delete/{id}', [App\Http\Controllers\HakaksesController::class, 'destroy'])->name('hakakses.delete');
    });

    // Employee routes
    Route::resource('employees', EmployeeController::class);
    Route::get('/employees/{employee}/upload-document', [EmployeeController::class, 'showUploadForm'])->name('employees.upload-form');
    Route::post('/employees/{employee}/upload-document', [EmployeeController::class, 'uploadDocument'])->name('employees.upload-document');

    // Example routes
    Route::get('/table-example', [ExampleController::class, 'table'])->name('table.example');
    Route::get('/clock-example', [ExampleController::class, 'clock'])->name('clock.example');
    Route::get('/chart-example', [ExampleController::class, 'chart'])->name('chart.example');
    Route::get('/form-example', [ExampleController::class, 'form'])->name('form.example');
    Route::get('/map-example', [ExampleController::class, 'map'])->name('map.example');
    Route::get('/calendar-example', [ExampleController::class, 'calendar'])->name('calendar.example');
    Route::get('/gallery-example', [ExampleController::class, 'gallery'])->name('gallery.example');
    Route::get('/todo-example', [ExampleController::class, 'todo'])->name('todo.example');
    Route::get('/contact-example', [ExampleController::class, 'contact'])->name('contact.example');
    Route::get('/faq-example', [ExampleController::class, 'faq'])->name('faq.example');
    Route::get('/news-example', [ExampleController::class, 'news'])->name('news.example');
    Route::get('/about-example', [ExampleController::class, 'about'])->name('about.example');

    // User management routes
    Route::post('/users/bulk-action', [UserController::class, 'bulkAction'])->name('users.bulk-action');
    Route::get('/users/filter', [UserController::class, 'filter'])->name('users.filter');
    Route::resource('users', UserController::class);

    // File Upload routes
    Route::post('/files/upload', [FileUploadController::class, 'store'])->name('files.upload');
    Route::get('/files/download/{file}', [FileUploadController::class, 'download'])->name('files.download');
});