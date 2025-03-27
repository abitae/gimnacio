<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassModel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'classes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'horario',
        'duracion',
        'instructor_id',
        'branch_id',
        'capacity'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'horario' => 'datetime:H:i',
    ];

    /**
     * Get the branch that owns the class.
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the instructor that owns the class.
     */
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'instructor_id');
    }

    /**
     * Get the enrollments for the class.
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'clase_id');
    }

    /**
     * Get current enrollments count.
     */
    public function getCurrentEnrollmentsCountAttribute(): int
    {
        return $this->enrollments()->count();
    }

    /**
     * Check if the class is full.
     */
    public function isFull(): bool
    {
        return $this->capacity && $this->current_enrollments_count >= $this->capacity;
    }
}
