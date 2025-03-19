<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\FormTemplate;
use App\Models\FormSubmission;
use App\Models\User;
use App\Models\FileUpload;

class DashboardController extends Controller
{
    /**
     * Display the dashboard index page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get counts for various entities to display on dashboard
        $stats = [
            'employees' => Employee::count(),
            'users' => User::count(),
            'formTemplates' => FormTemplate::count(),
            'formSubmissions' => FormSubmission::count(),
            'fileUploads' => FileUpload::count(),
        ];
        
        // Get the latest records of various entities
        $latestEmployees = Employee::latest()->take(5)->get();
        $latestFormTemplates = FormTemplate::latest()->take(5)->get();
        $latestFormSubmissions = FormSubmission::latest()->take(5)->get();
        $latestFileUploads = FileUpload::latest()->take(5)->get();
        
        // Pass all data to the view
        return view('dashboard.index', compact(
            'stats',
            'latestEmployees',
            'latestFormTemplates', 
            'latestFormSubmissions',
            'latestFileUploads'
        ));
    }
} 