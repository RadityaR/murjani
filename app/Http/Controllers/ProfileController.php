<?php
namespace App\Http\Controllers;

use App\Models\Education;
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'required|string|max:20',
            'department' => 'nullable|string|max:100',
            'position' => 'nullable|string|max:100',
            'employee_status' => 'nullable|string|in:Kontrak,PNS,PPPK',
            'golongan' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:500',
            'educations' => 'nullable|array',
            'educations.*.id' => 'nullable|exists:educations,id',
            'educations.*.type' => 'required|in:formal,informal',
            'educations.*.institution_name' => 'required|string|max:255',
            'educations.*.course_name' => 'required_if:educations.*.type,informal|nullable|string|max:255',
            'educations.*.start_date' => 'nullable|date',
            'educations.*.end_date' => 'nullable|date|after_or_equal:educations.*.start_date',
            'educations.*.description' => 'nullable|string',
            'educations.*.level' => [
                'nullable',
                Rule::requiredIf(fn ($attribute, $value, $fail) => {
                    $index = explode('.', $attribute)[1];
                    return isset($this->educations[$index]['type']) && $this->educations[$index]['type'] === 'formal';
                }),
                Rule::in(['SD', 'SLTP', 'SLTA', 'Diploma', 'S1', 'S2', 'S3', 'Spesialis', 'Sub Spesialis']),
            ],
        ]);

        try {
            DB::beginTransaction();

            $user = Auth::user();
            
            // Update user information
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->department = $request->input('department');
            $user->position = $request->input('position');
            $user->employee_status = $request->input('employee_status');
            $user->golongan = $request->input('golongan');
            $user->address = $request->input('address');
            $user->save();

            // Get or create employee record
            $employee = $user->employee ?? $user->employee()->create([
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'employee_status' => $user->employee_status,
                'golongan' => $user->golongan,
                'address' => $user->address,
            ]);

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