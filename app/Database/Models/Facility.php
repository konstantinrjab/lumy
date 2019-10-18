<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = [
        'user_id', 'title', 'price', 'currency', 'workingTime', 'transportTime', 'deadlineTime'
    ];
}
