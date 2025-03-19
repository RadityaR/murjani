<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormDocumentRequest;
use App\Models\FormDocument;
use App\Models\FormSubmission;
use App\Models\FormField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FormDocumentController extends Controller
{
    /**
     * Upload a document for a form submission.
     */
    public function store(FormDocumentRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        
        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();
            
            // Generate a unique filename
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            
            // Store the file
            $path = $file->storeAs('form-documents', $filename, 'public');
            
            // Set file information
            $data['original_filename'] = $originalName;
            $data['filename'] = $filename;
            $data['file_path'] = $path;
            $data['file_size'] = $fileSize;
            $data['mime_type'] = $mimeType;
            
            // Create the document record
            $document = FormDocument::create($data);
            
            return redirect()->route('form-submissions.show', $document->form_submission_id)
                ->with('success', 'Document uploaded successfully.');
        }
        
        return back()->with('error', 'No file uploaded.');
    }

    /**
     * Display the specified document.
     */
    public function show(FormDocument $formDocument)
    {
        if (!Storage::disk('public')->exists($formDocument->file_path)) {
            return back()->with('error', 'File not found.');
        }
        
        return response()->file(Storage::disk('public')->path($formDocument->file_path));
    }

    /**
     * Remove the specified document from storage.
     */
    public function destroy(FormDocument $formDocument)
    {
        $submissionId = $formDocument->form_submission_id;
        $submission = FormSubmission::find($submissionId);
        
        // Only allow deletion if the submission is still a draft or by the uploader/admin
        if ($submission && 
            ($submission->status === 'draft' || $formDocument->user_id === Auth::id() || Auth::user()->id === 1)) {
            
            // Delete the file
            if (Storage::disk('public')->exists($formDocument->file_path)) {
                Storage::disk('public')->delete($formDocument->file_path);
            }
            
            $formDocument->delete();
            
            return redirect()->route('form-submissions.show', $submissionId)
                ->with('success', 'Document deleted successfully.');
        }
        
        return redirect()->route('form-submissions.show', $submissionId)
            ->with('error', 'You are not authorized to delete this document.');
    }
    
    /**
     * Review a document.
     */
    public function review(Request $request, FormDocument $formDocument)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'review_notes' => 'nullable|string',
        ]);
        
        $formDocument->status = $request->status;
        $formDocument->review_notes = $request->review_notes;
        $formDocument->reviewed_by = Auth::id();
        $formDocument->reviewed_at = now();
        $formDocument->save();
        
        return redirect()->route('form-submissions.show', $formDocument->form_submission_id)
            ->with('success', 'Document reviewed successfully.');
    }
    
    /**
     * Download a document.
     */
    public function download(FormDocument $formDocument)
    {
        if (!Storage::disk('public')->exists($formDocument->file_path)) {
            return back()->with('error', 'File not found.');
        }
        
        return response()->download(
            Storage::disk('public')->path($formDocument->file_path),
            $formDocument->original_filename
        );
    }
} 