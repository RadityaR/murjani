<?php
namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();
            
            // Get or create employee record
            $employee = $user->employee;
            if (!$employee) {
                $employee = new \App\Models\Employee();
                $employee->user_id = $user->id;
            }

            // Update employee information
            $employee->full_name = $request->input('name');
            $employee->email = $request->input('email');
            $employee->phone_number = $request->input('phone');
            $employee->position = $request->input('position');
            $employee->employment_status = $request->input('employee_status');
            $employee->rank_class = $request->input('rank_class_id');
            $employee->unit = $request->input('unit_kerja');
            $employee->address = $request->input('address');
            $employee->birth_date = $request->input('birth_date');
            $employee->save();

            // Update department_id if provided
            if ($request->has('department_id')) {
                $employee->department_id = $request->input('department_id');
                $employee->save();
            }

            // Handle education records
            $currentEducationIds = $employee->educations()->pluck('id')->toArray();
            $submittedEducationIds = collect($request->input('educations', []))
                ->filter(fn($education) => !empty($education['id']))
                ->pluck('id')
                ->toArray();
            
            // Delete removed education records
            Education::whereIn('id', array_diff($currentEducationIds, $submittedEducationIds))
                ->where('employee_id', $employee->id)
                ->delete();

            // Update or create education records
            foreach ($request->input('educations', []) as $educationData) {
                if (!empty($educationData['id'])) {
                    Education::where('id', $educationData['id'])
                        ->where('employee_id', $employee->id)
                        ->update($educationData);
                } else {
                    Education::create(array_merge($educationData, ['employee_id' => $employee->id]));
                }
            }

            DB::commit();
            return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('profile.edit')->with('error', 'Failed to update profile: ' . $e->getMessage());
        }
    }

    public function changepassword()
    {
        return view('profile.changepassword', ['user' => Auth::user()]);
    }

    public function password(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
            'educations.*.level' => [
                'nullable',
                Rule::requiredIf(fn ($attribute) => 
                    request()->input("educations.".explode('.', $attribute)[1].".type") === 'formal'
                ),
                Rule::in(['SD', 'SLTP', 'SLTA', 'Diploma', 'S1', 'S2', 'S3', 'Spesialis', 'Sub Spesialis']),
            ],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password Sebelumnya Salah!']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('status', 'Password berhasil Diubah!');
    }
}