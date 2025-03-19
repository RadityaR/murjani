<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FormTemplateController;
use App\Http\Controllers\FormFieldController;
use App\Http\Controllers\FormSubmissionController;
use App\Http\Controllers\FormDocumentController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes (assuming you're using Laravel's built-in auth)
Auth::routes();

// Dashboard routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Home routes
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/blank', [HomeController::class, 'blank'])->name('blank');

// Employee routes (no auth required for testing)
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

// User management routes
Route::resource('users', UserController::class);

// Example routes for demonstration purposes
Route::get('/examples/blank', [ExampleController::class, 'blank'])->name('examples.blank');
Route::get('/examples/form', [ExampleController::class, 'form'])->name('examples.form');
Route::get('/examples/chart', [ExampleController::class, 'chart'])->name('examples.chart');
Route::get('/examples/table', [ExampleController::class, 'table'])->name('examples.table');

   // Form Templates
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
   
   // Form Submissions
   Route::resource('form-submissions', FormSubmissionController::class);
   Route::get('form-templates/{formTemplate}/submit', [FormSubmissionController::class, 'create'])
       ->name('form-submissions.create-from-template');
   Route::post('form-submissions/{formSubmission}/review', [FormSubmissionController::class, 'review'])
       ->name('form-submissions.review');
   
   // Form Documents
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


// Form Template Routes
// Route::middleware(['auth'])->group(function () {
 
// });
