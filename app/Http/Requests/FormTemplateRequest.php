<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormTemplateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'settings' => 'nullable|array',
            'max_file_uploads' => 'integer|min:0|max:100',
            'sort_order' => 'integer|min:0',
        ];

        // Add slug uniqueness validation only for new templates or when changing the slug
        if ($this->isMethod('post') || 
            ($this->isMethod('put') && $this->slug != $this->route('formTemplate')->slug)) {
            $rules['slug'] = 'required|string|max:255|unique:form_templates,slug';
        } else {
            $rules['slug'] = 'required|string|max:255';
        }

        return $rules;
    }
} 