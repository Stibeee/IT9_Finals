<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'product_name',
        'quantity',
        'price',
        'user_id',
        'total_price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
