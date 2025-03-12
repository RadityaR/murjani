<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
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
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'ktp_number' => ['sometimes', 'nullable', 'string', 'max:20'],
            'nip' => ['sometimes', 'nullable', 'string', 'max:20'],
            'golongan' => ['sometimes', 'nullable', 'string', 'max:10'],
            'employee_status' => ['sometimes', 'nullable', Rule::in(['Kontrak', 'PNS', 'PPPK'])],
            'address' => ['sometimes', 'required', 'string'],
            'phone' => ['sometimes', 'required', 'string', 'max:20'],
            'email' => [
                'sometimes', 
                'required', 
                'string', 
                'email', 
                'max:255', 
                Rule::unique('employees')->ignore($this->employee)
            ],
            'date_of_birth' => ['sometimes', 'required', 'date', 'before:today'],
            'gender' => ['sometimes', 'required', Rule::in(['Laki-Laki', 'Perempuan'])],
            'marital_status' => ['sometimes', 'required', Rule::in(['Belum Menikah', 'Menikah', 'Duda', 'Janda'])],
            'height_cm' => ['sometimes', 'required', 'integer', 'min:1', 'max:300'],
            'weight_kg' => ['sometimes', 'required', 'integer', 'min:1', 'max:500'],
            'blood_type' => ['sometimes', 'required', Rule::in(['A', 'B', 'AB', 'O'])],
            'religion' => ['sometimes', 'required', 'string', 'max:50'],
            'hobby' => ['sometimes', 'required', 'string', 'max:255'],
            
            // Education validation
            'educations' => ['sometimes', 'nullable', 'array'],
            'educations.*.id' => ['nullable', 'exists:educations,id'],
            'educations.*.type' => ['required', 'string', Rule::in(['formal', 'informal'])],
            'educations.*.institution_name' => ['required', 'string', 'max:255'],
            'educations.*.level' => [
                'nullable',
                Rule::requiredIf(function ($attribute, $value, $fail) {
                    $index = explode('.', $attribute)[1];
                    return isset($this->educations[$index]['type']) && $this->educations[$index]['type'] === 'formal';
                }),
                Rule::in(['SD', 'SLTP', 'SLTA', 'Perguruan Tinggi']),
            ],
            'educations.*.course_name' => [
                'nullable',
                Rule::requiredIf(function ($attribute, $value, $fail) {
                    $index = explode('.', $attribute)[1];
                    return isset($this->educations[$index]['type']) && $this->educations[$index]['type'] === 'informal';
                }),
                'string',
                'max:255',
            ],
            
            // Work Experience validation
            'work_experiences' => ['sometimes', 'nullable', 'array'],
            'work_experiences.*.id' => ['nullable', 'exists:work_experiences,id'],
            'work_experiences.*.company' => ['required', 'string', 'max:255'],
            'work_experiences.*.position' => ['nullable', 'string', 'max:255'],
            'work_experiences.*.start_date' => ['nullable', 'date'],
            'work_experiences.*.end_date' => ['nullable', 'date', 'after_or_equal:work_experiences.*.start_date'],
            'work_experiences.*.description' => ['nullable', 'string'],
        ];
    }
} 