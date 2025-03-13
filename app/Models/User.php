<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'nip',
        'password',
        'role',
        'is_active',
        'status',
        'notes',
        'permissions',
        'phone',
        'department',
        'position',
        'employee_status',
        'golongan',
        'address'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'permissions'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
        'email_verified_at' => 'datetime',
        'role' => 'string',
        'is_active' => 'boolean',
        'last_login_at' => 'datetime',
        'permissions' => 'json'
    ];

    /**
     * Check if the user is an admin
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user is active
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * Update last login timestamp
     */
    public function updateLastLogin(): void
    {
        $this->last_login_at = now();
        $this->save();
    }

    /**
     * Check if user has specific permission
     */
    public function hasPermission(string $permission): bool
    {
        if ($this->isAdmin()) {
            return true;
        }
        
        return in_array($permission, $this->permissions ?? []);
    }

    /**
     * Get user's full status
     */
    public function getStatusAttribute($value): string
    {
        if (!$this->is_active) {
            return 'inactive';
        }
        return $value;
    }

    /**
     * Get the user's education records through employee.
     */
    public function educations(): HasManyThrough
    {
        return $this->hasManyThrough(
            Education::class,
            Employee::class,
            'user_id', // Foreign key on employees table
            'employee_id', // Foreign key on educations table
            'id', // Local key on users table
            'id' // Local key on employees table
        );
    }

    /**
     * Get the user's employee record.
     */
    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class);
    }
}
