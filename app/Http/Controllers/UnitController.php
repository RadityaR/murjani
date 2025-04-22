<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::with('department')->orderBy('name')->get();
        return view('units.index', compact('units'));
    }

    public function create()
    {
        $departments = Department::where('is_active', true)->orderBy('name')->get();
        return view('units.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:units',
            'code' => 'required|string|max:50|unique:units',
            'description' => 'nullable|string',
            'department_id' => 'required|exists:departments,id',
            'location' => 'nullable|string|max:255',
            'is_active' => 'boolean'
        ]);

        try {
            DB::beginTransaction();

            Unit::create([
                'name' => $request->name,
                'code' => $request->code,
                'description' => $request->description,
                'department_id' => $request->department_id,
                'location' => $request->location,
                'is_active' => $request->boolean('is_active', true)
            ]);

            DB::commit();
            return redirect()->route('units.index')->with('success', 'Unit berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan unit');
        }
    }

    public function edit(Unit $unit)
    {
        $departments = Department::where('is_active', true)->orderBy('name')->get();
        return view('units.edit', compact('unit', 'departments'));
    }

    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:units,name,' . $unit->id,
            'code' => 'required|string|max:50|unique:units,code,' . $unit->id,
            'description' => 'nullable|string',
            'department_id' => 'required|exists:departments,id',
            'location' => 'nullable|string|max:255',
            'is_active' => 'boolean'
        ]);

        try {
            DB::beginTransaction();

            $unit->update([
                'name' => $request->name,
                'code' => $request->code,
                'description' => $request->description,
                'department_id' => $request->department_id,
                'location' => $request->location,
                'is_active' => $request->boolean('is_active', true)
            ]);

            DB::commit();
            return redirect()->route('units.index')->with('success', 'Unit berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui unit');
        }
    }

    public function destroy(Unit $unit)
    {
        try {
            DB::beginTransaction();

            if ($unit->employees()->exists()) {
                return redirect()->back()->with('error', 'Tidak dapat menghapus unit yang masih digunakan oleh pegawai');
            }

            $unit->delete();

            DB::commit();
            return redirect()->route('units.index')->with('success', 'Unit berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus unit');
        }
    }
} 