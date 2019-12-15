<?php

namespace App\Database\Models\User;

use Illuminate\Database\Eloquent\Model;

class UsersSocial extends Model
{
    protected $fillable = ['user_id', 'google_id', 'google_token'];
}
