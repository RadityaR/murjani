<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FormDocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // More detailed authorization in controller
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'form_submission_id' => 'required|exists:form_submissions,id',
            'form_field_id' => 'nullable|exists:form_fields,id',
            'document_type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => [
                'required',
                Rule::in(['pending', 'approved', 'rejected']),
            ],
            'review_notes' => 'nullable|string',
        ];
        
        // Add file validation only for file uploads
        if ($this->isMethod('post') || $this->isMethod('put')) {
            $rules['file'] = 'sometimes|required|file|max:10240'; // Max 10MB
            
            // If a form field is specified, check if it's a file field
            if ($this->has('form_field_id')) {
                $formFieldId = $this->input('form_field_id');
                $formField = \App\Models\FormField::find($formFieldId);
                
                if ($formField && $formField->field_type === 'file') {
                    // Add mime type validation if needed
                    if (!empty($formField->validation_rules) && isset($formField->validation_rules['mime_types'])) {
                        $rules['file'] .= '|mimes:' . $formField->validation_rules['mime_types'];
                    }
                }
            }
        }
        
        return $rules;
    }
} 