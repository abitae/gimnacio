<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'subscription_type_id',
        'start_date',
        'end_date',
        'cost'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get the customer that owns the subscription.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the subscription type that owns the subscription.
     */
    public function subscriptionType(): BelongsTo
    {
        return $this->belongsTo(SubscriptionType::class);
    }

    /**
     * Check if the subscription is active.
     */
    public function isActive(): bool
    {
        return now()->between($this->start_date, $this->end_date);
    }
}
