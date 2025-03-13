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
            'type' => ['sometimes', 'required', Rule::in(['formal', 'informal'])],
            'institution_name' => ['sometimes', 'required', 'string', 'max:255'],
            'level' => [
                'nullable',
                Rule::requiredIf(fn () => $this->type === 'formal'),
                Rule::in(['SD', 'SLTP', 'SLTA', 'Diploma', 'S1', 'S2', 'S3', 'Spesialis', 'Sub Spesialis']),
            ],
            'course_name' => [
                'nullable',
                Rule::requiredIf(fn () => $this->type === 'informal'),
                'string',
                'max:255',
            ],
        ];
    }
} 