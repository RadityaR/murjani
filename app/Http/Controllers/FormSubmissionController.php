<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormSubmissionRequest;
use App\Models\FormSubmission;
use App\Models\FormTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormSubmissionController extends Controller
{
    /**
     * Display a listing of the submissions.
     */
    public function index(Request $request)
    {
        $query = FormSubmission::query();
        
        // Filter by form template if provided
        if ($request->has('form_template_id')) {
            $query->where('form_template_id', $request->form_template_id);
        }
        
        // Filter by status if provided
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by user if provided
        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        
        // Sort by default with newest first
        $submissions = $query->with(['formTemplate', 'user', 'employee'])
            ->latest()
            ->paginate(15);
        
        $formTemplates = FormTemplate::active()->orderBy('name')->get();
        
        return view('form-submissions.index', compact('submissions', 'formTemplates'));
    }

    /**
     * Show the form for creating a new submission.
     */
    public function create(FormTemplate $formTemplate)
    {
        // Check if template is active
        if (!$formTemplate->is_active) {
            return redirect()->route('form-submissions.index')
                ->with('error', 'This form is not currently active.');
        }
        
        $formTemplate->load('fields');
        
        return view('form-submissions.create', compact('formTemplate'));
    }

    /**
     * Store a newly created submission in storage.
     */
    public function store(FormSubmissionRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        
        // Record IP and user agent
        $data['ip_address'] = $request->ip();
        $data['user_agent'] = $request->userAgent();
        
        // Set submitted_at timestamp if status is not draft
        if ($data['status'] !== 'draft') {
            $data['submitted_at'] = now();
        }
        
        $submission = FormSubmission::create($data);
        
        return redirect()->route('form-submissions.show', $submission->id)
            ->with('success', 'Form submitted successfully.');
    }

    /**
     * Display the specified submission.
     */
    public function show(FormSubmission $formSubmission)
    {
        $formSubmission->load(['formTemplate', 'formTemplate.fields', 'user', 'employee', 'documents']);
        
        return view('form-submissions.show', compact('formSubmission'));
    }

    /**
     * Show the form for editing the specified submission.
     */
    public function edit(FormSubmission $formSubmission)
    {
        // Only allow editing of draft submissions
        if ($formSubmission->status !== 'draft') {
            return redirect()->route('form-submissions.show', $formSubmission->id)
                ->with('error', 'Only draft submissions can be edited.');
        }
        
        $formSubmission->load(['formTemplate', 'formTemplate.fields']);
        
        return view('form-submissions.edit', compact('formSubmission'));
    }

    /**
     * Update the specified submission in storage.
     */
    public function update(FormSubmissionRequest $request, FormSubmission $formSubmission)
    {
        // Only allow updating of draft submissions
        if ($formSubmission->status !== 'draft' && Auth::user()->id !== 1) { // Assuming admin has ID 1, adjust as needed
            return redirect()->route('form-submissions.show', $formSubmission->id)
                ->with('error', 'Only draft submissions can be updated.');
        }
        
        $data = $request->validated();
        
        // Set submitted_at timestamp if status is changing from draft to something else
        if ($formSubmission->status === 'draft' && $data['status'] !== 'draft') {
            $data['submitted_at'] = now();
        }
        
        $formSubmission->update($data);
        
        return redirect()->route('form-submissions.show', $formSubmission->id)
            ->with('success', 'Form submission updated successfully.');
    }

    /**
     * Remove the specified submission from storage.
     */
    public function destroy(FormSubmission $formSubmission)
    {
        // Only allow deletion of draft submissions or by admins
        if ($formSubmission->status !== 'draft' && Auth::user()->id !== 1) { // Assuming admin has ID 1, adjust as needed
            return redirect()->route('form-submissions.show', $formSubmission->id)
                ->with('error', 'Only draft submissions can be deleted.');
        }
        
        $formSubmission->delete();
        
        return redirect()->route('form-submissions.index')
            ->with('success', 'Form submission deleted successfully.');
    }
    
    /**
     * Review a form submission.
     */
    public function review(Request $request, FormSubmission $formSubmission)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'notes' => 'nullable|string',
        ]);
        
        $formSubmission->status = $request->status;
        $formSubmission->notes = $request->notes;
        $formSubmission->reviewed_by = Auth::id();
        $formSubmission->reviewed_at = now();
        $formSubmission->save();
        
        return redirect()->route('form-submissions.show', $formSubmission->id)
            ->with('success', 'Form submission reviewed successfully.');
    }

    /**
     * Display a list of the current user's form submissions.
     *
     * @return \Illuminate\View\View
     */
    public function userSubmissions()
    {
        $submissions = FormSubmission::where('user_id', auth()->id())
            ->with('formTemplate')
            ->latest()
            ->paginate(10);
            
        return view('form-submissions.user-submissions', compact('submissions'));
    }
} 