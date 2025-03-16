<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FamilyMember extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employee_id',
        'full_name',
        'relationship',
        'identity_number',
        'birth_date',
        'gender',
        'occupation',
        'education_level',
        'is_dependent',
        'is_emergency_contact',
        'phone_number',
        'address',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth_date' => 'date',
        'is_dependent' => 'boolean',
        'is_emergency_contact' => 'boolean',
        'gender' => 'string',
        'relationship' => 'string',
    ];

    /**
     * Get the employee that owns the family member.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
} 