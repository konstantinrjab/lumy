<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Deal extends Model
{
    protected $fillable = [
        'user_id',
        'client_id',
        'status',
        'title',
        'address',
        'price', 'currency',
        'prepay_price',
        'prepay_currency',
        'start',
        'end',
        'deadline',
        'comment'
    ];

    protected $dates = [
        'start', 'end', 'deadline'
    ];

    public function facilities(): HasMany
    {
        return $this->hasMany(DealFacility::class);
    }
}
