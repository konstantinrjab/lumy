<?php

namespace App\Database\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        self::created(function (User $model) {
            Profile::create([
                'user_id'             => $model->id,
                'work_hours_in_month' => Profile::PROFILE_DEFAULT_WORK_HOURS_IN_MONTH,
                'salary'              => Profile::PROFILE_DEFAULT_SALARY,
                'currency'            => Profile::PROFILE_DEFAULT_CURRENCY,
            ]);
        });
    }
}
