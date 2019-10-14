<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $fillable = ['user_id', 'title', 'address', 'price', 'currency', 'datetime', 'deadline'];
}
