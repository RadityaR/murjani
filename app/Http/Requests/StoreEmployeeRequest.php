<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'ktp_number' => ['nullable', 'string', 'max:20'],
            'nip' => ['nullable', 'string', 'max:20'],
            'golongan' => ['nullable', 'string', 'max:500'],
            'employee_status' => ['nullable', Rule::in(['Kontrak', 'PNS', 'PPPK'])],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:employees'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'gender' => ['required', Rule::in(['Laki-Laki', 'Perempuan'])],
            'marital_status' => ['required', Rule::in(['Belum Menikah', 'Menikah', 'Duda', 'Janda'])],
            'height_cm' => ['required', 'integer', 'min:1', 'max:300'],
            'weight_kg' => ['required', 'integer', 'min:1', 'max:500'],
            'blood_type' => ['required', Rule::in(['A', 'B', 'AB', 'O'])],
            'religion' => ['required', 'string', 'max:50'],
            'hobby' => ['required', 'string', 'max:255'],
            'employee_document' => ['nullable', 'file', 'mimes:doc,docx', 'max:5120'], // Max 5MB
            // Education validation
            'educations' => ['nullable', 'array'],
            'educations.*.type' => ['required', 'string', Rule::in(['formal', 'informal'])],
            'educations.*.institution_name' => ['required', 'string', 'max:255'],
            'educations.*.level' => [
                'nullable',
                Rule::requiredIf(function () {
                    return collect($this->input('educations', []))->contains('type', 'formal');
                }),
                Rule::in(['SD', 'SLTP', 'SLTA', 'Diploma', 'S1', 'S2', 'S3', 'Spesialis', 'Sub Spesialis']),
            ],
            'educations.*.course_name' => [
                'nullable',
                Rule::requiredIf(function () {
                    return collect($this->input('educations', []))->contains('type', 'informal');
                }),
                'string',
                'max:255',
            ],
            
            // Work Experience validation
            'work_experiences' => ['nullable', 'array'],
            'work_experiences.*.company' => ['required', 'string', 'max:255'],
            'work_experiences.*.position' => ['nullable', 'string', 'max:255'],
            'work_experiences.*.start_date' => ['nullable', 'date'],
            'work_experiences.*.end_date' => ['nullable', 'date', 'after_or_equal:work_experiences.*.start_date'],
            'work_experiences.*.description' => ['nullable', 'string'],
        ];
    }
} 