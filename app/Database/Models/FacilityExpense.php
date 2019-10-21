<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityExpense extends Model
{
    protected $fillable = ['facility_id', 'title', 'price', 'currency', 'number'];
}
