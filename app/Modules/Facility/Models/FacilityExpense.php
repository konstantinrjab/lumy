<?php

namespace App\Modules\Facility\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityExpense extends Model
{
    protected $fillable = ['facility_id', 'title', 'price', 'currency', 'number'];
}
