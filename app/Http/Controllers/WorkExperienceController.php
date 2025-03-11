<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkExperienceRequest;
use App\Http\Requests\UpdateWorkExperienceRequest;
use App\Models\Employee;
use App\Models\WorkExperience;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WorkExperienceController extends Controller
{
    /**
     * Show the form for creating a new work experience record.
     */
    public function create(Employee $employee): View
    {
        return view('work-experiences.create', compact('employee'));
    }

    /**
     * Store a newly created work experience record in storage.
     */
    public function store(StoreWorkExperienceRequest $request, Employee $employee): RedirectResponse
    {
        $employee->workExperiences()->create($request->validated());
        
        return redirect()->route('employees.show', $employee)
            ->with('success', 'Work experience added successfully.');
    }

    /**
     * Show the form for editing the specified work experience record.
     */
    public function edit(Employee $employee, WorkExperience $workExperience): View
    {
        return view('work-experiences.edit', compact('employee', 'workExperience'));
    }

    /**
     * Update the specified work experience record in storage.
     */
    public function update(UpdateWorkExperienceRequest $request, Employee $employee, WorkExperience $workExperience): RedirectResponse
    {
        $workExperience->update($request->validated());
        
        return redirect()->route('employees.show', $employee)
            ->with('success', 'Work experience updated successfully.');
    }

    /**
     * Remove the specified work experience record from storage.
     */
    public function destroy(Employee $employee, WorkExperience $workExperience): RedirectResponse
    {
        $workExperience->delete();
        
        return redirect()->route('employees.show', $employee)
            ->with('success', 'Work experience deleted successfully.');
    }
} 