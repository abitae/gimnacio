<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalStudy extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cliente_id',
        'fecha',
        'peso',
        'altura',
        'presion_arterial',
        'recomendaciones'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha' => 'date',
        'peso' => 'decimal:2',
        'altura' => 'decimal:2',
    ];

    /**
     * Get the customer that owns the medical study.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'cliente_id');
    }

    /**
     * Get the BMI (Body Mass Index).
     */
    public function getBmiAttribute(): ?float
    {
        if (!$this->peso || !$this->altura) {
            return null;
        }

        // BMI = weight(kg) / (height(m))²
        $heightInMeters = $this->altura / 100; // Convertir de cm a metros
        return $this->peso / ($heightInMeters * $heightInMeters);
    }
}
