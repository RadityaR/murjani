<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeSkillRequest extends FormRequest
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
            'skill_id' => ['required', 'exists:skills,id'],
            'proficiency_level' => ['required', 'integer', 'min:1', 'max:5'],
            'notes' => ['nullable', 'string'],
            'acquired_date' => ['nullable', 'date'],
            'last_used_date' => ['nullable', 'date'],
        ];
    }
} 