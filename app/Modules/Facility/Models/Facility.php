<?php

namespace App\Modules\Facility\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Facility extends \Eloquent
{
    protected $fillable = [
        'user_id', 'title', 'price', 'is_active', 'currency', 'working_time', 'transport_time', 'deadline_time'
    ];

    public function expenses(): HasMany
    {
        return $this->hasMany(FacilityExpense::class);
    }
}
