<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'location',
        'phone',
        'email',
        'company_id'
    ];

    /**
     * Get the company that owns the branch.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the employees for the branch.
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    /**
     * Get the customers for the branch.
     */
    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }

    /**
     * Get the classes for the branch.
     */
    public function classes(): HasMany
    {
        return $this->hasMany(ClassModel::class);
    }

    /**
     * Get the employee schedules for the branch.
     */
    public function employeeSchedules(): HasMany
    {
        return $this->hasMany(EmployeeSchedule::class);
    }
}
