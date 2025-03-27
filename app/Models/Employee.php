<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'puesto',
        'fecha_contratacion',
        'email',
        'status',
        'branch_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_contratacion' => 'date',
    ];

    /**
     * Get the branch that owns the employee.
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the schedules for the employee.
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(EmployeeSchedule::class);
    }

    /**
     * Get the attendances for the employee.
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(EmployeeAttendance::class, 'empleado_id');
    }

    /**
     * Get the classes that the employee instructs.
     */
    public function classes(): HasMany
    {
        return $this->hasMany(ClassModel::class, 'instructor_id');
    }

    /**
     * Get the full name of the employee.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->nombre} {$this->apellido}";
    }
}
