<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormTemplateRequest;
use App\Models\FormTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormTemplateController extends Controller
{
    /**
     * Display a listing of form templates.
     */
    public function index()
    {
        $formTemplates = FormTemplate::orderBy('sort_order')->get();
        
        return view('form-templates.index', compact('formTemplates'));
    }

    /**
     * Show the form for creating a new form template.
     */
    public function create()
    {
        return view('form-templates.create');
    }

    /**
     * Store a newly created form template in storage.
     */
    public function store(FormTemplateRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = Auth::id();
        $data['updated_by'] = Auth::id();
        
        // Generate slug if not provided
        if (!isset($data['slug']) || empty($data['slug'])) {
            $data['slug'] = FormTemplate::generateSlug($data['name']);
        }
        
        $formTemplate = FormTemplate::create($data);
        
        return redirect()->route('form-templates.edit', $formTemplate->id)
            ->with('success', 'Form template created successfully. Now you can add fields to it.');
    }

    /**
     * Display the specified form template.
     */
    public function show(FormTemplate $formTemplate)
    {
        $formTemplate->load('fields', 'creator');
        
        return view('form-templates.show', compact('formTemplate'));
    }

    /**
     * Show the form for editing the specified form template.
     */
    public function edit(FormTemplate $formTemplate)
    {
        $formTemplate->load('fields');
        
        return view('form-templates.edit', compact('formTemplate'));
    }

    /**
     * Update the specified form template in storage.
     */
    public function update(FormTemplateRequest $request, FormTemplate $formTemplate)
    {
        $data = $request->validated();
        $data['updated_by'] = Auth::id();
        
        $formTemplate->update($data);
        
        return redirect()->route('form-templates.index')
            ->with('success', 'Form template updated successfully.');
    }

    /**
     * Remove the specified form template from storage.
     */
    public function destroy(FormTemplate $formTemplate)
    {
        // Check if there are submissions for this template
        if ($formTemplate->submissions()->count() > 0) {
            return redirect()->route('form-templates.index')
                ->with('error', 'Cannot delete this form template because it has submissions.');
        }
        
        $formTemplate->delete();
        
        return redirect()->route('form-templates.index')
            ->with('success', 'Form template deleted successfully.');
    }
    
    /**
     * Toggle the active status of the form template.
     */
    public function toggleActive(FormTemplate $formTemplate)
    {
        $formTemplate->is_active = !$formTemplate->is_active;
        $formTemplate->updated_by = Auth::id();
        $formTemplate->save();
        
        $status = $formTemplate->is_active ? 'activated' : 'deactivated';
        
        return redirect()->route('form-templates.index')
            ->with('success', "Form template {$status} successfully.");
    }
} 