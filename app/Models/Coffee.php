<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coffee extends Model
{
    use hasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'coffee_user');
    }

    protected $fillable = [
        'coffee_title',
        'detail',
        'price',
        'image',
        'availability'

    ];

}
