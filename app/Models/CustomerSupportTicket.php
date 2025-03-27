<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerSupportTicket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'issue_date',
        'issue_description',
        'status',
        'resolution_date'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'issue_date' => 'datetime',
        'resolution_date' => 'datetime',
    ];

    /**
     * Get the customer that owns the support ticket.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Resolve the ticket.
     */
    public function resolve(): void
    {
        $this->status = 'closed';
        $this->resolution_date = now();
        $this->save();
    }

    /**
     * Set the ticket to in progress.
     */
    public function inProgress(): void
    {
        $this->status = 'in_progress';
        $this->save();
    }
}
