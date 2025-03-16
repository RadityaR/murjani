<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFamilyMemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'employee_id' => ['required', 'exists:employees,id'],
            'full_name' => ['required', 'string', 'max:255'],
            'relationship' => ['required', Rule::in(['spouse', 'child', 'parent', 'sibling', 'other'])],
            'identity_number' => ['nullable', 'string', 'max:50'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'occupation' => ['nullable', 'string', 'max:100'],
            'education_level' => ['nullable', 'string', 'max:50'],
            'is_dependent' => ['boolean'],
            'is_emergency_contact' => ['boolean'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
        ];
    }
} 