<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'category',
        'price',
        'tax',
        'currency',
        'active',
    ];

}
