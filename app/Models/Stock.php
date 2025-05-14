<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'ingredient_name',
        'quantity',
        'unit',
        'minimum_stock'
    ];

    public function histories()
    {
        return $this->hasMany(StockHistory::class);
    }

    public function isLow()
    {
        return $this->quantity <= $this->minimum_stock;
    }

    public function deduct($amount, $notes = null)
    {
        if ($this->quantity >= $amount) {
            $previousQuantity = $this->quantity;
            $this->quantity -= $amount;
            $this->save();

            // Record the deduction in history
            $this->histories()->create([
                'type' => 'out',
                'quantity' => $amount,
                'previous_quantity' => $previousQuantity,
                'new_quantity' => $this->quantity,
                'notes' => $notes
            ]);

            return true;
        }
        return false;
    }

    public function add($amount, $notes = null)
    {
        $previousQuantity = $this->quantity;
        $this->quantity += $amount;
        $this->save();

        // Record the addition in history
        $this->histories()->create([
            'type' => 'in',
            'quantity' => $amount,
            'previous_quantity' => $previousQuantity,
            'new_quantity' => $this->quantity,
            'notes' => $notes
        ]);

        return true;
    }
}