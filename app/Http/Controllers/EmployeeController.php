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

class EmployeeController extends Controller
{
    /**
     * Display a listing of employees.
     */
    public function index(): View
    {
        $employees = Employee::latest()->paginate(10);
        
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create(): View
    {
        return view('employees.create');
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(StoreEmployeeRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        
        try {
            // Create employee
            $validatedData = $request->validated();
            $employee = Employee::create($validatedData);
            
            // Create educations if provided
            if (!empty($validatedData['educations'])) {
                foreach ($validatedData['educations'] as $educationData) {
                    $employee->educations()->create($educationData);
                }
            }
            
            // Create work experiences if provided
            if (!empty($validatedData['work_experiences'])) {
                foreach ($validatedData['work_experiences'] as $workExperienceData) {
                    $employee->workExperiences()->create($workExperienceData);
                }
            }
            
            DB::commit();
            
            return redirect()->route('employees.show', $employee)
                ->with('success', 'Employee created successfully with education and work experience.');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create employee. ' . $e->getMessage());
        }
    }

    /**
     * Display the specified employee.
     */
    public function show(Employee $employee): View
    {
        // Load relationships for display
        $employee->load(['educations', 'workExperiences']);
        
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit(Employee $employee): View
    {
        // Load relationships for the form
        $employee->load(['educations', 'workExperiences']);
        
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse
    {
        DB::beginTransaction();
        
        try {
            // Update employee
            $validatedData = $request->validated();
            $employee->update($validatedData);
            
            // Update educations if provided
            if (isset($validatedData['educations'])) {
                $this->syncEducations($employee, $validatedData['educations']);
            }
            
            // Update work experiences if provided
            if (isset($validatedData['work_experiences'])) {
                $this->syncWorkExperiences($employee, $validatedData['work_experiences']);
            }
            
            DB::commit();
            
            return redirect()->route('employees.show', $employee)
                ->with('success', 'Employee updated successfully with education and work experience.');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update employee. ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified employee from storage.
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();
        
        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
    
    /**
     * Sync education records for an employee.
     */
    private function syncEducations(Employee $employee, array $educations): void
    {
        // Get current education IDs
        $currentIds = $employee->educations->pluck('id')->toArray();
        $newIds = [];
        
        foreach ($educations as $educationData) {
            if (!empty($educationData['id'])) {
                // Update existing education
                $education = Education::find($educationData['id']);
                if ($education && $education->employee_id === $employee->id) {
                    $education->update($educationData);
                    $newIds[] = $education->id;
                }
            } else {
                // Create new education
                $education = $employee->educations()->create($educationData);
                $newIds[] = $education->id;
            }
        }
        
        // Delete educations that are not in the new list
        $idsToDelete = array_diff($currentIds, $newIds);
        if (!empty($idsToDelete)) {
            Education::whereIn('id', $idsToDelete)->delete();
        }
    }
    
    /**
     * Sync work experience records for an employee.
     */
    private function syncWorkExperiences(Employee $employee, array $workExperiences): void
    {
        // Get current work experience IDs
        $currentIds = $employee->workExperiences->pluck('id')->toArray();
        $newIds = [];
        
        foreach ($workExperiences as $workExperienceData) {
            if (!empty($workExperienceData['id'])) {
                // Update existing work experience
                $workExperience = WorkExperience::find($workExperienceData['id']);
                if ($workExperience && $workExperience->employee_id === $employee->id) {
                    $workExperience->update($workExperienceData);
                    $newIds[] = $workExperience->id;
                }
            } else {
                // Create new work experience
                $workExperience = $employee->workExperiences()->create($workExperienceData);
                $newIds[] = $workExperience->id;
            }
        }
        
        // Delete work experiences that are not in the new list
        $idsToDelete = array_diff($currentIds, $newIds);
        if (!empty($idsToDelete)) {
            WorkExperience::whereIn('id', $idsToDelete)->delete();
        }
    }
} 