<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'stripe_payment_id',
        'stripe_charge_id',
        'metadata',
        'refunded_at'
    ];

    protected $casts = [
        'metadata' => 'array',
        'refunded_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 