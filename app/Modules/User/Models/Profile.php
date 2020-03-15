<?php

namespace App\Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends \Eloquent
{
    public const DEFAULT_WORK_HOURS_IN_MONTH = 160;
    public const DEFAULT_DESIRED_INCOME_NOMINAL = 20000;
    public const DEFAULT_DESIRED_INCOME_CURRENCY = 'uah';
    public const DEFAULT_LANGUAGE = 'ru';
    public const DEFAULT_THEME = 'dark';

    protected $fillable = ['user_id', 'work_hours_in_month', 'desired_income_nominal', 'desired_income_currency', 'language', 'theme'];
}
