<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'coffee_title',
        'food_title',
        'detail',
        'price',
        'image',
        'quantity',

    ];
}
