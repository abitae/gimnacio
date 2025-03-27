<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'fecha_nacimiento',
        'email',
        'telefono',
        'direccion',
        'branch_id',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    /**
     * Get the branch that owns the customer.
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the subscriptions for the customer.
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Get the accesses for the customer.
     */
    public function accesses(): HasMany
    {
        return $this->hasMany(CustomerAccess::class);
    }

    /**
     * Get the feedback for the customer.
     */
    public function feedback(): HasMany
    {
        return $this->hasMany(CustomerFeedback::class);
    }

    /**
     * Get the interactions for the customer.
     */
    public function interactions(): HasMany
    {
        return $this->hasMany(CustomerInteraction::class);
    }

    /**
     * Get the support tickets for the customer.
     */
    public function supportTickets(): HasMany
    {
        return $this->hasMany(CustomerSupportTicket::class);
    }

    /**
     * Get the medical studies for the customer.
     */
    public function medicalStudies(): HasMany
    {
        return $this->hasMany(MedicalStudy::class, 'cliente_id');
    }

    /**
     * Get the payments for the customer.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the enrollments for the customer.
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'cliente_id');
    }
}
