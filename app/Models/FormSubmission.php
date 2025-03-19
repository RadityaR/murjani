<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormSubmission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'form_template_id',
        'user_id',
        'employee_id',
        'form_data',
        'status',
        'notes',
        'reviewed_by',
        'submitted_at',
        'reviewed_at',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'form_data' => 'array',
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the form template for this submission
     */
    public function formTemplate()
    {
        return $this->belongsTo(FormTemplate::class);
    }

    /**
     * Get the user who created this submission
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the employee associated with this submission
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Get the user who reviewed this submission
     */
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Get all documents attached to this submission
     */
    public function documents()
    {
        return $this->hasMany(FormDocument::class);
    }

    /**
     * Scope a query to only include submissions with a specific status
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Check if the submission is in draft status
     */
    public function isDraft()
    {
        return $this->status === 'draft';
    }

    /**
     * Check if the submission has been submitted
     */
    public function isSubmitted()
    {
        return $this->status === 'submitted';
    }

    /**
     * Check if the submission is approved
     */
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    /**
     * Check if the submission is rejected
     */
    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    /**
     * Get the status badge color
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'approved' => 'success',
            'rejected' => 'danger',
            'submitted' => 'primary',
            'in_review' => 'info',
            default => 'warning',
        };
    }
} 