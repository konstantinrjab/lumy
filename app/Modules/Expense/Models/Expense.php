<?php

namespace App\Modules\Expense\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends \Eloquent
{
    protected $fillable = [
        'user_id',
        'title',
        'price',
        'currency',
        'type',
        'start_date',
        'period',
        'is_active'
    ];

    protected $dates = [
        'start_date',
    ];
}
