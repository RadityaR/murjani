<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEducationRequest extends FormRequest
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
            'employee_id' => ['sometimes', 'required', 'exists:employees,id'],
            'education_type' => ['sometimes', 'required', Rule::in(['formal', 'informal', 'certification'])],
            'institution_name' => ['sometimes', 'required', 'string', 'max:255'],
            'education_level' => [
                'nullable',
                Rule::requiredIf(fn () => $this->input('education_type') === 'formal'),
                Rule::in(['elementary', 'junior_high', 'high_school', 'diploma', 'bachelor', 'master', 'doctorate', 'specialist', 'sub_specialist']),
            ],
            'major' => ['nullable', 'string', 'max:255'],
            'degree' => ['nullable', 'string', 'max:100'],
            'start_year' => ['nullable', 'integer', 'min:1900', 'max:' . date('Y')],
            'graduation_year' => [
                'nullable', 
                'integer', 
                'min:1900', 
                'max:' . (date('Y') + 10),
                'gte:start_year'
            ],
            'gpa' => ['nullable', 'numeric', 'min:0', 'max:4.0'],
            'certificate_number' => ['nullable', 'string', 'max:100'],
        ];
    }
} 