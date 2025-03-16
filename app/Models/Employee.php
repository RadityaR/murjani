<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nip',
        'full_name',
        'identity_number',
        'position_id',
        'department_id',
        'unit_id',
        'rank_class_id',
        'employment_status',
        'license_status',
        'address',
        'phone_number',
        'birth_date',
        'gender',
        'marital_status',
        'height_cm',
        'weight_kg',
        'blood_type',
        'religion',
        'hobbies',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth_date' => 'date',
        'height_cm' => 'integer',
        'weight_kg' => 'integer',
        'employment_status' => 'string',
        'license_status' => 'string',
        'gender' => 'string',
        'marital_status' => 'string',
        'blood_type' => 'string',
    ];

    /**
     * Get the user that owns the employee.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the position that owns the employee.
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Get the department that owns the employee.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the unit that owns the employee.
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Get the rank class that owns the employee.
     */
    public function rankClass(): BelongsTo
    {
        return $this->belongsTo(RankClass::class);
    }

    /**
     * Get the educations for the employee.
     */
    public function educations(): HasMany
    {
        return $this->hasMany(Education::class);
    }

    /**
     * Get the work experiences for the employee.
     */
    public function workExperiences(): HasMany
    {
        return $this->hasMany(WorkExperience::class);
    }

    /**
     * Get the documents for the employee.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    /**
     * Get the family members for the employee.
     */
    public function familyMembers(): HasMany
    {
        return $this->hasMany(FamilyMember::class);
    }

    /**
     * The skills that belong to the employee.
     */
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class)
            ->withPivot('proficiency_level', 'notes', 'acquired_date', 'last_used_date')
            ->withTimestamps();
    }
} 