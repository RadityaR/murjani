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
            // Basic employee information
            'user_id' => ['nullable', 'exists:users,id'],
            'nip' => ['nullable', 'string', 'max:20'],
            'full_name' => ['required', 'string', 'max:255'],
            'identity_number' => ['nullable', 'string', 'max:20'],
            'position_id' => ['required', 'exists:positions,id'],
            'department_id' => ['required', 'exists:departments,id'],
            'unit_id' => ['required', 'exists:units,id'],
            'rank_class_id' => ['nullable', 'exists:rank_classes,id'],
            'employment_status' => ['required', Rule::in(['contract', 'civil_servant', 'temporary'])],
            'license_status' => ['nullable', Rule::in(['active', 'expired', 'none'])],
            'address' => ['required', 'string'],
            'phone_number' => ['required', 'string', 'max:20'],
            'birth_date' => ['required', 'date', 'before:today'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'marital_status' => ['required', Rule::in(['single', 'married', 'widowed', 'divorced'])],
            'height_cm' => ['required', 'integer', 'min:1', 'max:300'],
            'weight_kg' => ['required', 'integer', 'min:1', 'max:500'],
            'blood_type' => ['required', Rule::in(['A', 'B', 'AB', 'O'])],
            'religion' => ['required', 'string', 'max:50'],
            'hobbies' => ['nullable', 'string', 'max:255'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            
            // Education information
            'educations' => ['nullable', 'array'],
            'educations.*.id' => ['nullable', 'exists:educations,id'],
            'educations.*.education_type' => ['required', 'string', Rule::in(['formal', 'informal', 'certification'])],
            'educations.*.institution_name' => ['required', 'string', 'max:255'],
            'educations.*.education_level' => [
                'nullable',
                Rule::requiredIf(function () {
                    return collect($this->input('educations', []))->contains('education_type', 'formal');
                }),
                Rule::in(['elementary', 'junior_high', 'high_school', 'diploma', 'bachelor', 'master', 'doctorate', 'specialist', 'sub_specialist']),
            ],
            'educations.*.major' => ['nullable', 'string', 'max:255'],
            'educations.*.degree' => ['nullable', 'string', 'max:100'],
            'educations.*.start_year' => ['nullable', 'integer', 'min:1900', 'max:' . date('Y')],
            'educations.*.graduation_year' => [
                'nullable', 
                'integer', 
                'min:1900', 
                'max:' . (date('Y') + 10),
                'gte:educations.*.start_year'
            ],
            'educations.*.gpa' => ['nullable', 'numeric', 'min:0', 'max:4.0'],
            'educations.*.certificate_number' => ['nullable', 'string', 'max:100'],
            
            // Work Experience information
            'work_experiences' => ['nullable', 'array'],
            'work_experiences.*.id' => ['nullable', 'exists:work_experiences,id'],
            'work_experiences.*.company_name' => ['required', 'string', 'max:255'],
            'work_experiences.*.position' => ['required', 'string', 'max:255'],
            'work_experiences.*.department' => ['nullable', 'string', 'max:255'],
            'work_experiences.*.location' => ['nullable', 'string', 'max:255'],
            'work_experiences.*.employment_type' => ['nullable', 'string', 'max:100'],
            'work_experiences.*.start_date' => ['required', 'date'],
            'work_experiences.*.end_date' => ['nullable', 'date', 'after_or_equal:work_experiences.*.start_date'],
            'work_experiences.*.is_current' => ['boolean'],
            'work_experiences.*.responsibilities' => ['nullable', 'string'],
            'work_experiences.*.achievements' => ['nullable', 'string'],
            'work_experiences.*.reference_name' => ['nullable', 'string', 'max:255'],
            'work_experiences.*.reference_contact' => ['nullable', 'string', 'max:100'],
            
            // Family Members information
            'family_members' => ['nullable', 'array'],
            'family_members.*.id' => ['nullable', 'exists:family_members,id'],
            'family_members.*.full_name' => ['required', 'string', 'max:255'],
            'family_members.*.relationship' => ['required', 'string', 'max:50'],
            'family_members.*.identity_number' => ['nullable', 'string', 'max:50'],
            'family_members.*.birth_date' => ['required', 'date'],
            'family_members.*.gender' => ['required', Rule::in(['male', 'female'])],
            'family_members.*.occupation' => ['nullable', 'string', 'max:100'],
            'family_members.*.education_level' => ['nullable', 'string', 'max:50'],
            'family_members.*.is_dependent' => ['boolean'],
            'family_members.*.is_emergency_contact' => ['boolean'],
            'family_members.*.phone_number' => ['nullable', 'string', 'max:20'],
            'family_members.*.address' => ['nullable', 'string'],
            'family_members.*.notes' => ['nullable', 'string'],
            
            // Skills information
            'skills' => ['nullable', 'array'],
            'skills.*.id' => ['nullable', 'exists:employee_skill,id'],
            'skills.*.skill_id' => ['required', 'exists:skills,id'],
            'skills.*.proficiency_level' => ['required', 'integer', 'min:1', 'max:5'],
            'skills.*.notes' => ['nullable', 'string'],
            'skills.*.acquired_date' => ['nullable', 'date'],
            'skills.*.last_used_date' => ['nullable', 'date'],
            
            // Documents
            'documents' => ['nullable', 'array'],
            'documents.*.id' => ['nullable', 'exists:documents,id'],
            'documents.*.file' => ['nullable', 'file', 'max:10240'], // 10MB max
            'documents.*.document_type' => ['required', 'string', 'max:50'],
            'documents.*.description' => ['nullable', 'string'],
        ];
    }
} 