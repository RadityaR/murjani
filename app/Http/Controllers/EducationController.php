<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEducationRequest;
use App\Http\Requests\UpdateEducationRequest;
use App\Models\Education;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EducationController extends Controller
{
    /**
     * Show the form for creating a new education record.
     */
    public function create(Employee $employee): View
    {
        return view('educations.create', compact('employee'));
    }

    /**
     * Store a newly created education record in storage.
     */
    public function store(StoreEducationRequest $request, Employee $employee): RedirectResponse
    {
        $employee->educations()->create($request->validated());
        
        return redirect()->route('employees.show', $employee)
            ->with('success', 'Education record added successfully.');
    }

    /**
     * Show the form for editing the specified education record.
     */
    public function edit(Employee $employee, Education $education): View
    {
        return view('educations.edit', compact('employee', 'education'));
    }

    /**
     * Update the specified education record in storage.
     */
    public function update(UpdateEducationRequest $request, Employee $employee, Education $education): RedirectResponse
    {
        $education->update($request->validated());
        
        return redirect()->route('employees.show', $employee)
            ->with('success', 'Education record updated successfully.');
    }

    /**
     * Remove the specified education record from storage.
     */
    public function destroy(Employee $employee, Education $education): RedirectResponse
    {
        $education->delete();
        
        return redirect()->route('employees.show', $employee)
            ->with('success', 'Education record deleted successfully.');
    }
} 