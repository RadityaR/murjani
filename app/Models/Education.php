<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Education extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'educations';

    protected $fillable = [
        'employee_id',
        'type',
        'institution_name',
        'course_name',
        'start_date',
        'end_date',
        'description'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
} 