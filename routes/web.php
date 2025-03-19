<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormTemplateController;
use App\Http\Controllers\FormFieldController;
use App\Http\Controllers\FormSubmissionController;
use App\Http\Controllers\FormDocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HakAksesController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('user', [AuthController::class, 'user'])->name('user');

    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Home routes
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/blank', [HomeController::class, 'blank'])->name('blank');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // File upload routes
    Route::resource('files', FileUploadController::class);
    Route::get('files/{file}/download', [FileUploadController::class, 'download'])->name('files.download');
    Route::post('files/{file}/validate', [FileUploadController::class, 'validateFile'])->name('files.validate');

    // User management routes (admin only)
    // Route::middleware(['permission:manage_users'])->group(function () {
    Route::group([], function () {
        Route::resource('users', UserController::class);
        Route::post('users/bulk-action', [UserController::class, 'bulkAction'])->name('users.bulk-action');
        Route::get('users/filter', [UserController::class, 'filter'])->name('users.filter');
    });

    // HakAkses routes
    Route::resource('hakakses', HakAksesController::class);
    Route::post('hakakses/{hakakses}/delete', [HakAksesController::class, 'destroy'])->name('hakakses.delete');

    // Employee routes
    // Route::middleware(['permission:manage_employees'])->group(function () {
    Route::group([], function () {
        Route::resource('employees', EmployeeController::class);
        Route::get('employees/{employee}/upload-document', [EmployeeController::class, 'showUploadForm'])->name('employees.upload-document');
        Route::post('employees/{employee}/upload-document', [EmployeeController::class, 'uploadDocument'])->name('employees.upload-document.store');
        Route::get('employees/{employee}/upload-form', [EmployeeController::class, 'showUploadForm'])->name('employees.upload-form');
    });

    // Form Templates
    // Route::middleware(['permission:manage_forms'])->group(function () {
    Route::group([], function () {
        Route::resource('form-templates', FormTemplateController::class);
        Route::put('form-templates/{formTemplate}/toggle-active', [FormTemplateController::class, 'toggleActive'])
            ->name('form-templates.toggle-active');
        
        // Form Fields
        Route::post('form-templates/{formTemplate}/fields', [FormFieldController::class, 'store'])
            ->name('form-fields.store');
        Route::put('form-templates/{formTemplate}/fields/{formField}', [FormFieldController::class, 'update'])
            ->name('form-fields.update');
        Route::delete('form-templates/{formTemplate}/fields/{formField}', [FormFieldController::class, 'destroy'])
            ->name('form-fields.destroy');
        Route::post('form-templates/{formTemplate}/fields/order', [FormFieldController::class, 'updateOrder'])
            ->name('form-fields.order');
    });
    
    // Form Submissions
    // Route::middleware(['permission:submit_forms'])->group(function () {
    Route::group([], function () {
        Route::resource('form-submissions', FormSubmissionController::class);
        Route::get('form-templates/{formTemplate}/submit', [FormSubmissionController::class, 'create'])
            ->name('form-submissions.create-from-template');
        Route::post('form-submissions/{formSubmission}/review', [FormSubmissionController::class, 'review'])
            ->name('form-submissions.review');
    });
    
    // Form Documents
    // Route::middleware(['permission:manage_documents'])->group(function () {
    Route::group([], function () {
        Route::post('form-documents', [FormDocumentController::class, 'store'])
            ->name('form-documents.store');
        Route::get('form-documents/{formDocument}', [FormDocumentController::class, 'show'])
            ->name('form-documents.show');
        Route::get('form-documents/{formDocument}/download', [FormDocumentController::class, 'download'])
            ->name('form-documents.download');
        Route::delete('form-documents/{formDocument}', [FormDocumentController::class, 'destroy'])
            ->name('form-documents.destroy');
        Route::post('form-documents/{formDocument}/review', [FormDocumentController::class, 'review'])
            ->name('form-documents.review');
    });
});

// // Example routes for demonstration purposes
// Route::get('/examples/blank', [ExampleController::class, 'blank'])->name('examples.blank');
// Route::get('/examples/form', [ExampleController::class, 'form'])->name('examples.form');
// Route::get('/examples/chart', [ExampleController::class, 'chart'])->name('examples.chart');
// Route::get('/examples/table', [ExampleController::class, 'table'])->name('examples.table');
