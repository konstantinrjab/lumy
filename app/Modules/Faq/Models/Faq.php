<?php

namespace App\Modules\Faq\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends \Eloquent
{
    protected $fillable = ['alias', 'title', 'text'];
}
