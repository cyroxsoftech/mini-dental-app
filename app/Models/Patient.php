<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'occupation',
        'gender',
        'birthdate',
        'blood_group',
        'counntry',
        'city',
        'address',
    ];
}
