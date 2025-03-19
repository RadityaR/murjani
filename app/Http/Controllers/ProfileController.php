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
            
            // Update user information
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->position = $request->input('position');
            $user->employee_status = $request->input('employee_status');
            $user->golongan_pangkat = $request->input('golongan_pangkat');
            $user->jabatan = $request->input('jabatan');
            $user->unit_kerja = $request->input('unit_kerja');
            $user->address = $request->input('address');
            $user->save();

            // Get or create employee record
            $employee = $user->employee ?? $user->employee()->create([
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'employee_status' => $user->employee_status,
                'golongan_pangkat' => $user->golongan_pangkat,
                'jabatan' => $user->jabatan,
                'unit_kerja' => $user->unit_kerja,
                'address' => $user->address,
            ]);

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

            return redirect()->route('profile.edit')->with('status', 'Profile updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error updating profile: ' . $e->getMessage());
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