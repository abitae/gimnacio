<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrollment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cliente_id',
        'clase_id',
        'fecha_inscripcion'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_inscripcion' => 'date',
    ];

    /**
     * Get the customer that owns the enrollment.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'cliente_id');
    }

    /**
     * Get the class that owns the enrollment.
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(ClassModel::class, 'clase_id');
    }
}
