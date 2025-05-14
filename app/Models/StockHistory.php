<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
    protected $fillable = [
        'stock_id',
        'type',
        'quantity',
        'previous_quantity',
        'new_quantity',
        'notes'
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}