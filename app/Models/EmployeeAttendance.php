<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeAttendance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'empleado_id',
        'fecha',
        'hora_entrada',
        'hora_salida'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha' => 'date',
        'hora_entrada' => 'datetime:H:i',
        'hora_salida' => 'datetime:H:i',
    ];

    /**
     * Get the employee that owns the attendance.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'empleado_id');
    }
}
