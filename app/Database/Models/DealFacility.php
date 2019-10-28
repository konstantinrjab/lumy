<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class DealFacility extends Model
{
    protected $fillable = ['deal_id', 'facility_id', 'number'];
}