<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsentRecord extends Model
{
    protected $table = 'consent_records';
    protected $fillable = ['guid', 'accepted_at', 'version', 'ip', 'user_agent'];
    protected $dates = ['accepted_at'];
}