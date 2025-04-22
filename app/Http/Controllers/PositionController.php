<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::orderBy('title')->get();
        return view('positions.index', compact('positions'));
    }

    public function create()
    {
        return view('positions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:positions',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        try {
            DB::beginTransaction();

            Position::create([
                'title' => $request->title,
                'description' => $request->description,
                'is_active' => $request->boolean('is_active', true)
            ]);

            DB::commit();
            return redirect()->route('positions.index')->with('success', 'Profesi berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan profesi');
        }
    }

    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:positions,title,' . $position->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        try {
            DB::beginTransaction();

            $position->update([
                'title' => $request->title,
                'description' => $request->description,
                'is_active' => $request->boolean('is_active', true)
            ]);

            DB::commit();
            return redirect()->route('positions.index')->with('success', 'Profesi berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui profesi');
        }
    }

    public function destroy(Position $position)
    {
        try {
            DB::beginTransaction();

            if ($position->employees()->exists()) {
                return redirect()->back()->with('error', 'Tidak dapat menghapus profesi yang masih digunakan oleh pegawai');
            }

            $position->delete();

            DB::commit();
            return redirect()->route('positions.index')->with('success', 'Profesi berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus profesi');
        }
    }
} 