<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Education extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'educations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employee_id',
        'education_type',
        'institution_name',
        'education_level',
        'major',
        'degree',
        'start_year',
        'graduation_year',
        'gpa',
        'certificate_number',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_year' => 'integer',
        'graduation_year' => 'integer',
        'gpa' => 'decimal:2',
    ];

    /**
     * Get the employee that owns the education.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
} 