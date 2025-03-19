<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormDocument extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'form_submission_id',
        'form_field_id',
        'user_id',
        'filename',
        'original_filename',
        'file_path',
        'mime_type',
        'file_size',
        'document_type',
        'description',
        'status',
        'review_notes',
        'reviewed_at',
        'reviewed_by',
    ];

    protected $casts = [
        'file_size' => 'integer',
        'reviewed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the submission that owns the document
     */
    public function formSubmission()
    {
        return $this->belongsTo(FormSubmission::class);
    }

    /**
     * Get the form field associated with this document (if any)
     */
    public function formField()
    {
        return $this->belongsTo(FormField::class);
    }

    /**
     * Get the user who uploaded the document
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user who reviewed the document
     */
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Get the full URL for the file
     */
    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

    /**
     * Get the file extension
     */
    public function getFileExtensionAttribute()
    {
        return pathinfo($this->filename, PATHINFO_EXTENSION);
    }

    /**
     * Get the status badge color
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'approved' => 'success',
            'rejected' => 'danger',
            default => 'warning',
        };
    }

    /**
     * Get the status label
     */
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            default => 'Pending',
        };
    }
} 