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

class EmployeeController extends Controller
{
    /**
     * Display a listing of employees.
     */
    public function index(): View
    {
        if (auth()->user()->role === 'admin') {
            $employees = Employee::latest()->paginate(10);
        } else {
            $employees = Employee::where('nip', auth()->user()->nip)->paginate(10);
        }
        
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create(): View
    {
        $user = auth()->user();
        
        // Check if employee data already exists for this user
        $existingEmployee = Employee::where('nip', $user->nip)->first();
        if ($existingEmployee) {
            return redirect()->route('employees.show', $existingEmployee)
                ->with('error', 'Data pegawai Anda sudah ada dalam sistem.');
        }

        // Allow admin to create any employee, or user to create their own data
        if ($user->role === 'admin' || !$existingEmployee) {
            return view('employees.create', ['user' => $user]);
        }

        abort(403, 'Unauthorized action.');
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(StoreEmployeeRequest $request): RedirectResponse
    {
        $user = auth()->user();
        
        // Check if employee data already exists for this user
        $existingEmployee = Employee::where('nip', $user->nip)->first();
        if ($existingEmployee) {
            return redirect()->route('employees.show', $existingEmployee)
                ->with('error', 'Data pegawai Anda sudah ada dalam sistem.');
        }

        try {
            DB::beginTransaction();

            $data = $request->validated();
            
            // If regular user is creating their own data, force their NIP
            if ($user->role !== 'admin') {
                $data['nip'] = $user->nip;
            }

            $employee = Employee::create($data);

            if ($request->hasFile('employee_document')) {
                $file = $request->file('employee_document');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('employee-documents', $filename, 'public');
                $employee->update(['employee_document' => $filename]);
            }

            DB::commit();

            return redirect()->route('home')
                ->with('success', 'Data pegawai berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error creating employee: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified employee.
     */
    public function show(Employee $employee): View
    {
        if (auth()->user()->role !== 'admin' && auth()->user()->nip !== $employee->nip) {
            abort(403, 'Unauthorized action.');
        }

        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit(Employee $employee): View
    {
        if (auth()->user()->role !== 'admin' && auth()->user()->nip !== $employee->nip) {
            abort(403, 'Unauthorized action.');
        }

        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse
    {
        if (auth()->user()->role !== 'admin' && auth()->user()->nip !== $employee->nip) {
            abort(403, 'Unauthorized action.');
        }

        try {
            DB::beginTransaction();

            $employee->update($request->validated());

            DB::commit();

            return redirect()->route('employees.show', $employee)
                ->with('success', 'Employee updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error updating employee: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified employee from storage.
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        if (!auth()->user()->role === 'admin') {
            abort(403, 'Unauthorized action.');
        }

        try {
            if ($employee->employee_document) {
                Storage::disk('public')->delete('employee-documents/' . $employee->employee_document);
            }
            $employee->delete();
            return redirect()->route('employees.index')
                ->with('success', 'Employee deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting employee: ' . $e->getMessage());
        }
    }

    /**
     * Show upload document form
     */
    public function showUploadForm(Employee $employee): View
    {
        if (auth()->user()->role !== 'admin' && auth()->user()->nip !== $employee->nip) {
            abort(403, 'Unauthorized action.');
        }

        return view('employees.upload-document', compact('employee'));
    }

    /**
     * Upload employee document
     */
    public function uploadDocument(Request $request, Employee $employee): RedirectResponse
    {
        if (auth()->user()->role !== 'admin' && auth()->user()->nip !== $employee->nip) {
            abort(403, 'Unauthorized action.');
        }

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