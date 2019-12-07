<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['alias', 'title', 'text'];
}
