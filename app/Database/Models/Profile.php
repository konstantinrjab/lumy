<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public const PROFILE_DEFAULT_WORK_HOURS_IN_MONTH = 160;
    public const PROFILE_DEFAULT_SALARY = 20000;
    public const PROFILE_DEFAULT_CURRENCY = 'uah';

    protected $fillable = ['work_hours_in_month', 'salary', 'currency'];
}
