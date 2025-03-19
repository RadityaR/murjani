<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FormSubmissionRequest extends FormRequest
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
            'form_template_id' => 'required|exists:form_templates,id',
            'employee_id' => 'nullable|exists:employees,id',
            'form_data' => 'required|array',
            'status' => [
                'required',
                Rule::in(['draft', 'submitted', 'in_review', 'approved', 'rejected']),
            ],
            'notes' => 'nullable|string',
            'ip_address' => 'nullable|ip',
            'user_agent' => 'nullable|string|max:255',
        ];
        
        // Add dynamic validation for form fields based on the template
        if ($this->has('form_template_id')) {
            $formTemplateId = $this->input('form_template_id');
            $formFields = \App\Models\FormField::where('form_template_id', $formTemplateId)->get();
            
            foreach ($formFields as $field) {
                $fieldKey = 'form_data.' . $field->key;
                $validationRules = [];
                
                // Add required validation if the field is required
                if ($field->is_required) {
                    $validationRules[] = 'required';
                } else {
                    $validationRules[] = 'nullable';
                }
                
                // Add field type specific validation
                switch ($field->field_type) {
                    case 'email':
                        $validationRules[] = 'email';
                        break;
                    case 'number':
                        $validationRules[] = 'numeric';
                        break;
                    case 'date':
                        $validationRules[] = 'date';
                        break;
                    case 'datetime':
                        $validationRules[] = 'date';
                        break;
                    case 'time':
                        $validationRules[] = 'date_format:H:i';
                        break;
                    case 'url':
                        $validationRules[] = 'url';
                        break;
                    case 'tel':
                        $validationRules[] = 'regex:/^[0-9\+\-\(\)\/\s]*$/';
                        break;
                    case 'select':
                    case 'radio':
                        if ($field->options) {
                            $validationRules[] = Rule::in(array_keys((array)$field->options));
                        }
                        break;
                    case 'checkbox':
                    case 'multiselect':
                        $validationRules[] = 'array';
                        if ($field->options) {
                            $validationRules[] = 'in:' . implode(',', array_keys((array)$field->options));
                        }
                        break;
                }
                
                // Add min/max length validation if specified
                if (!is_null($field->min_length)) {
                    $validationRules[] = 'min:' . $field->min_length;
                }
                
                if (!is_null($field->max_length)) {
                    $validationRules[] = 'max:' . $field->max_length;
                }
                
                // Add any custom validation rules from JSON field
                if ($field->validation_rules) {
                    foreach ((array)$field->validation_rules as $rule) {
                        $validationRules[] = $rule;
                    }
                }
                
                $rules[$fieldKey] = $validationRules;
            }
        }
        
        return $rules;
    }
} 