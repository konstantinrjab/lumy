<?php

namespace App\Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends \Eloquent
{
    protected $fillable = ['name', 'slug'];
}
