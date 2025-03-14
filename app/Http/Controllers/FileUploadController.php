<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function index()
    {
        $files = FileUpload::with('user')->latest()->get();
        return view('files.index', compact('files'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'document' => 'required|file|max:10240', // Max 10MB
            'description' => 'nullable|string|max:255',
            'document_type' => 'nullable|string|max:50',
        ]);

        $file = $request->file('document');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $filename, 'public');

        FileUpload::create([
            'user_id' => auth()->id(),
            'filename' => $filename,
            'original_name' => $file->getClientOriginalName(),
            'description' => $request->description,
            'document_type' => $request->document_type,
            'status' => 'pending',
            'file_path' => $path,
        ]);

        return redirect()->back()->with('success', 'Berkas berhasil diupload.');
    }

    public function download(FileUpload $file)
    {
        return Storage::disk('public')->download($file->file_path, $file->original_name);
    }

    public function validateFile(Request $request, FileUpload $file)
    {
        $request->validate([
            'validation_notes' => 'required|string|max:1000',
            'status' => 'required|in:validated,rejected',
        ]);

        $file->update([
            'status' => $request->status,
            'validation_notes' => $request->validation_notes,
            'validated_at' => now(),
            'validated_by' => auth()->id(),
        ]);

        $statusMessage = $request->status === 'validated' ? 'divalidasi' : 'ditolak';
        return redirect()->back()->with('success', "Berkas berhasil {$statusMessage}.");
    }

    public function destroy(FileUpload $file)
    {
        Storage::disk('public')->delete($file->file_path);
        $file->delete();
        return redirect()->back()->with('success', 'Berkas berhasil dihapus.');
    }
}
