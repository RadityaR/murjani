<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'filename',
        'original_name',
        'description',
        'status',
        'file_path',
        'document_type',
        'validation_notes',
        'validated_at',
        'validated_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'validated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'validated' => 'success',
            'rejected' => 'danger',
            default => 'warning',
        };
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'validated' => 'Tervalidasi',
            'rejected' => 'Ditolak',
            default => 'Menunggu',
        };
    }

    public function getDocumentTypeLabelAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->document_type)) ?: 'Umum';
    }
}
