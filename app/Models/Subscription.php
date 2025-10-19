<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'email',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
