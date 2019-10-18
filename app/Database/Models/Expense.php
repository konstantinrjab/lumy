<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['user_id', 'title', 'price', 'currency', 'type'];
}
