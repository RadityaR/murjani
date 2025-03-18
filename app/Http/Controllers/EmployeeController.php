<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Models\Education;
use App\Models\WorkExperience;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Department;
use App\Models\Position;
use App\Models\Unit;
use App\Models\RankClass;

class EmployeeController extends Controller
{
    /**
     * Display a listing of employees.
     */
    public function index(): View
    {
        try {
            $employees = Employee::with(['department', 'position', 'unit', 'rankClass'])
                ->latest()
                ->paginate(10);
            
            return view('employees.index', compact('employees'));
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error in employee index: ' . $e->getMessage());
            
            // Return an empty collection if there's an error
            $employees = collect([]);
            return view('employees.index', compact('employees'))->with('error', 'Could not load employees. Check logs for details.');
        }
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create(): View
    {
        $departments = Department::all();
        $positions = Position::all();
        $units = Unit::all();
        $rankClasses = RankClass::all();
        
        return view('employees.create', compact(
            'departments',
            'positions',
            'units',
            'rankClasses'
        ));
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(StoreEmployeeRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            // Prepare data for employee creation
            $employeeData = $request->safe()->except([
                'educations', 
                'work_experiences', 
                'family_members',
                'skills',
                'documents',
                'profile_picture'
            ]);
            
            // Handle profile picture upload
            if ($request->hasFile('profile_picture')) {
                $profilePicture = $request->file('profile_picture');
                $fileName = time() . '_' . $profilePicture->getClientOriginalName();
                $profilePicture->storeAs('public/profile-pictures', $fileName);
                $employeeData['profile_picture'] = $fileName;
            }

            // Create employee
            $employee = Employee::create($employeeData);

            // Handle educations
            if ($request->has('educations')) {
                foreach ($request->educations as $education) {
                    $employee->educations()->create($education);
                }
            }

            // Handle work experiences
            if ($request->has('work_experiences')) {
                foreach ($request->work_experiences as $experience) {
                    $employee->workExperiences()->create($experience);
                }
            }

            // Handle family members
            if ($request->has('family_members')) {
                foreach ($request->family_members as $member) {
                    $employee->familyMembers()->create($member);
                }
            }

            // Handle skills
            if ($request->has('skills')) {
                foreach ($request->skills as $skill) {
                    $employee->skills()->attach($skill['skill_id'], [
                        'proficiency_level' => $skill['proficiency_level'],
                        'notes' => $skill['notes'] ?? null,
                        'acquired_date' => $skill['acquired_date'] ?? null,
                        'last_used_date' => $skill['last_used_date'] ?? null
                    ]);
                }
            }

            // Handle documents
            if ($request->has('documents')) {
                foreach ($request->file('documents') as $document) {
                    $path = $document['file']->store('employee-documents', 'public');
                    $employee->documents()->create([
                        'file_path' => $path,
                        'document_type' => $document['document_type'],
                        'description' => $document['description'] ?? null,
                        'uploaded_by' => 1 // Default admin ID for testing
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('employees.show', $employee)
                ->with('success', 'Employee data has been created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error creating employee: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified employee.
     */
    public function show(Employee $employee): View
    {
        $employee->load([
            'department',
            'position',
            'unit',
            'rankClass',
            'educations',
            'workExperiences',
            'familyMembers',
            'skills',
            'documents'
        ]);

        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit(Employee $employee): View
    {
        $departments = Department::all();
        $positions = Position::all();
        $units = Unit::all();
        $rankClasses = RankClass::all();
        
        $employee->load([
            'educations',
            'workExperiences',
            'familyMembers',
            'skills',
            'documents'
        ]);

        return view('employees.edit', compact(
            'employee',
            'departments',
            'positions',
            'units',
            'rankClasses'
        ));
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse
    {
        try {
            DB::beginTransaction();

            // Prepare data for employee update
            $employeeData = $request->safe()->except([
                'educations', 
                'work_experiences', 
                'family_members',
                'skills',
                'documents',
                'profile_picture'
            ]);
            
            // Handle profile picture upload
            if ($request->hasFile('profile_picture')) {
                // Delete old profile picture if exists
                if ($employee->profile_picture) {
                    Storage::delete('public/profile-pictures/' . $employee->profile_picture);
                }
                
                $profilePicture = $request->file('profile_picture');
                $fileName = time() . '_' . $profilePicture->getClientOriginalName();
                $profilePicture->storeAs('public/profile-pictures', $fileName);
                $employeeData['profile_picture'] = $fileName;
            }

            // Update employee
            $employee->update($employeeData);

            // Handle educations
            if ($request->has('educations')) {
                $employee->educations()->delete();
                foreach ($request->educations as $education) {
                    $employee->educations()->create($education);
                }
            }

            // Handle work experiences
            if ($request->has('work_experiences')) {
                $employee->workExperiences()->delete();
                foreach ($request->work_experiences as $experience) {
                    $employee->workExperiences()->create($experience);
                }
            }

            // Handle family members
            if ($request->has('family_members')) {
                $employee->familyMembers()->delete();
                foreach ($request->family_members as $member) {
                    $employee->familyMembers()->create($member);
                }
            }

            // Handle skills
            if ($request->has('skills')) {
                $employee->skills()->detach();
                foreach ($request->skills as $skill) {
                    $employee->skills()->attach($skill['skill_id'], [
                        'proficiency_level' => $skill['proficiency_level'],
                        'notes' => $skill['notes'] ?? null,
                        'acquired_date' => $skill['acquired_date'] ?? null,
                        'last_used_date' => $skill['last_used_date'] ?? null
                    ]);
                }
            }

            // Handle documents
            if ($request->has('documents')) {
                foreach ($request->file('documents') as $document) {
                    $path = $document['file']->store('employee-documents', 'public');
                    $employee->documents()->create([
                        'file_path' => $path,
                        'document_type' => $document['document_type'],
                        'description' => $document['description'] ?? null,
                        'uploaded_by' => 1 // Default admin ID for testing
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('employees.show', $employee)
                ->with('success', 'Employee data has been updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error updating employee: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified employee from storage.
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        try {
            DB::beginTransaction();
            
            // Delete related documents from storage
            foreach ($employee->documents as $document) {
                Storage::disk('public')->delete($document->file_path);
            }
            
            $employee->delete();
            
            DB::commit();
            return redirect()->route('employees.index')
                ->with('success', 'Employee has been deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error deleting employee: ' . $e->getMessage());
        }
    }

    /**
     * Show upload document form
     */
    public function showUploadForm(Employee $employee): View
    {
        $employee->load(['department', 'position', 'unit', 'rankClass', 'user']);
        return view('employees.upload-document', compact('employee'));
    }

    /**
     * Upload employee document
     */
    public function uploadDocument(Request $request, Employee $employee): RedirectResponse
    {
        $request->validate([
            'employee_document' => 'required|file|mimes:doc,docx,pdf|max:5120'
        ]);

        try {
            if ($employee->employee_document) {
                Storage::disk('public')->delete('employee-documents/' . $employee->employee_document);
            }

            $file = $request->file('employee_document');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('employee-documents', $filename, 'public');
            
            $employee->update(['employee_document' => $filename]);

            return redirect()->route('employees.show', $employee)
                ->with('success', 'Document uploaded successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error uploading document: ' . $e->getMessage());
        }
    }
} 