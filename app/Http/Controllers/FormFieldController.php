<?php

namespace App\Http\Controllers;

use App\Models\FormField;
use App\Models\FormTemplate;
use Illuminate\Http\Request;

class FormFieldController extends Controller
{
    /**
     * Store a newly created form field in storage.
     */
    public function store(Request $request, FormTemplate $formTemplate)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'key' => 'required|string|max:255|unique:form_fields,key,NULL,id,form_template_id,' . $formTemplate->id,
            'label' => 'required|string|max:255',
            'field_type' => 'required|string',
            'description' => 'nullable|string',
            'placeholder' => 'nullable|string',
            'help_text' => 'nullable|string',
            'default_value' => 'nullable|string',
            'options' => 'nullable|array',
            'validation_rules' => 'nullable|array',
            'is_required' => 'boolean',
            'is_unique' => 'boolean',
            'is_visible' => 'boolean',
            'is_editable' => 'boolean',
            'min_length' => 'nullable|integer|min:0',
            'max_length' => 'nullable|integer|min:0',
            'sort_order' => 'integer|min:0',
            'section' => 'nullable|string|max:255',
            'width' => 'string|in:full,half,third,quarter',
            'conditional_logic' => 'nullable|array',
        ]);
        
        $validated['form_template_id'] = $formTemplate->id;
        
        $formField = FormField::create($validated);
        
        return redirect()->route('form-templates.edit', $formTemplate->id)
            ->with('success', 'Field added successfully.');
    }

    /**
     * Update the specified form field in storage.
     */
    public function update(Request $request, FormTemplate $formTemplate, FormField $formField)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'key' => 'required|string|max:255|unique:form_fields,key,' . $formField->id . ',id,form_template_id,' . $formTemplate->id,
            'label' => 'required|string|max:255',
            'field_type' => 'required|string',
            'description' => 'nullable|string',
            'placeholder' => 'nullable|string',
            'help_text' => 'nullable|string',
            'default_value' => 'nullable|string',
            'options' => 'nullable|array',
            'validation_rules' => 'nullable|array',
            'is_required' => 'boolean',
            'is_unique' => 'boolean',
            'is_visible' => 'boolean',
            'is_editable' => 'boolean',
            'min_length' => 'nullable|integer|min:0',
            'max_length' => 'nullable|integer|min:0',
            'sort_order' => 'integer|min:0',
            'section' => 'nullable|string|max:255',
            'width' => 'string|in:full,half,third,quarter',
            'conditional_logic' => 'nullable|array',
        ]);
        
        $formField->update($validated);
        
        return redirect()->route('form-templates.edit', $formTemplate->id)
            ->with('success', 'Field updated successfully.');
    }

    /**
     * Remove the specified form field from storage.
     */
    public function destroy(FormTemplate $formTemplate, FormField $formField)
    {
        // Check if the form template has submissions
        if ($formTemplate->submissions()->count() > 0) {
            return redirect()->route('form-templates.edit', $formTemplate->id)
                ->with('error', 'Cannot delete field because this form template has submissions.');
        }
        
        $formField->delete();
        
        return redirect()->route('form-templates.edit', $formTemplate->id)
            ->with('success', 'Field deleted successfully.');
    }
    
    /**
     * Update the sort order of multiple fields.
     */
    public function updateOrder(Request $request, FormTemplate $formTemplate)
    {
        $request->validate([
            'fields' => 'required|array',
            'fields.*.id' => 'required|integer|exists:form_fields,id',
            'fields.*.sort_order' => 'required|integer|min:0',
        ]);
        
        foreach ($request->fields as $field) {
            FormField::where('id', $field['id'])
                ->where('form_template_id', $formTemplate->id)
                ->update(['sort_order' => $field['sort_order']]);
        }
        
        return response()->json(['success' => true]);
    }
} 