<?php

namespace App\Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class UsersSocial extends Model
{
    protected $fillable = ['user_id', 'google_id', 'google_credentials'];
}
