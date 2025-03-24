<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
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
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthenticatedMiddleware;
use App\Http\Middleware\SuperadminMiddleware;

// Pre-login system selection routes
Route::get('/', function () {
    return view('pre-login');
})->name('systems.choose');

Route::get('/kepegawaian', function () {
    return view('kepegawaian');
})->name('kepegawaian');

Route::get('/diklat', function () {
    return view('diklat');
})->name('diklat');

// Diklat subsystem routes
Route::get('/pendidikan', function () {
    return view('pendidikan');
})->name('pendidikan');

Route::get('/pelatihan', function () {
    return view('pelatihan');
})->name('pelatihan');

// Pendidikan subsystem information pages
Route::get('/tata-tertib', function () {
    return view('tata-tertib');
})->name('tata-tertib');

Route::get('/hak-kewajiban', function () {
    return view('hak-kewajiban');
})->name('hak-kewajiban');

Route::get('/preceptor', function () {
    return view('preceptor');
})->name('preceptor');

// Pelatihan subsystem information pages
Route::get('/prosedur-penelitian', function () {
    return view('prosedur-penelitian');
})->name('prosedur-penelitian');

// Authentication routes - available but not required
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Routes for authenticated users (any role)
Route::middleware(AuthenticatedMiddleware::class)->group(function () {
    // Home route for all users
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('user', [AuthController::class, 'user'])->name('user');
    
    // Profile routes
    Route::get('/profile/change-password', [ProfileController::class, 'changepassword'])->name('profile.changepassword');
    Route::post('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Employee data submission routes for all authenticated users
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');

    // File download for authenticated users
    Route::get('files/{file}/download', [FileUploadController::class, 'download'])->name('files.download');

    // Public document routes for users with employee data
    Route::get('/form-templates/list', [FormTemplateController::class, 'userList'])->name('form-templates.user-list');
    Route::get('/form-templates/{formTemplate}/submit', [FormSubmissionController::class, 'create'])
        ->name('form-submissions.create-from-template');
    Route::post('/form-submissions', [FormSubmissionController::class, 'store'])->name('form-submissions.store');
    Route::get('/form-submissions/my-submissions', [FormSubmissionController::class, 'userSubmissions'])
        ->name('form-submissions.user-submissions');
});

// Routes for admin and superadmin
Route::middleware(AdminMiddleware::class)->group(function () {
    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/blank', [HomeController::class, 'blank'])->name('blank');

    // File upload management
    Route::resource('files', FileUploadController::class)->except(['download']);
    Route::post('files/{file}/validate', [FileUploadController::class, 'validateFile'])->name('files.validate');

    // Employee management
    Route::get('employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    Route::get('employees/{employee}/upload-document', [EmployeeController::class, 'showUploadForm'])->name('employees.upload-document');
    Route::post('employees/{employee}/upload-document', [EmployeeController::class, 'uploadDocument'])->name('employees.upload-document.store');
    Route::get('employees/{employee}/upload-form', [EmployeeController::class, 'showUploadForm'])->name('employees.upload-form');

    // Form Management
    Route::resource('form-templates', FormTemplateController::class)->except(['userList']);
    Route::put('form-templates/{formTemplate}/toggle-active', [FormTemplateController::class, 'toggleActive'])
        ->name('form-templates.toggle-active');

    // Form Fields Management
    Route::post('form-templates/{formTemplate}/fields', [FormFieldController::class, 'store'])
        ->name('form-fields.store');
    Route::put('form-templates/{formTemplate}/fields/{formField}', [FormFieldController::class, 'update'])
        ->name('form-fields.update');
    Route::delete('form-templates/{formTemplate}/fields/{formField}', [FormFieldController::class, 'destroy'])
        ->name('form-fields.destroy');
    Route::post('form-templates/{formTemplate}/fields/order', [FormFieldController::class, 'updateOrder'])
        ->name('form-fields.order');

    // Form Submissions Management
    Route::resource('form-submissions', FormSubmissionController::class)->except(['create', 'store', 'userSubmissions']);
    Route::post('form-submissions/{formSubmission}/review', [FormSubmissionController::class, 'review'])
        ->name('form-submissions.review');

    // Form Documents Management
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

// Superadmin only routes
Route::middleware(SuperadminMiddleware::class)->group(function () {
    // User management routes
    Route::resource('users', UserController::class);
    Route::post('users/bulk-action', [UserController::class, 'bulkAction'])->name('users.bulk-action');
    Route::get('users/filter', [UserController::class, 'filter'])->name('users.filter');
});

// // Example routes for demonstration purposes
// Route::get('/examples/blank', [ExampleController::class, 'blank'])->name('examples.blank');
// Route::get('/examples/form', [ExampleController::class, 'form'])->name('examples.form');
// Route::get('/examples/chart', [ExampleController::class, 'chart'])->name('examples.chart');
// Route::get('/examples/table', [ExampleController::class, 'table'])->name('examples.table');
