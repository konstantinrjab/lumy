<?php

namespace App\Database\Models;

use App\Database\Traits\HasRoles;
use App\Notifications\PasswordReset;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    public const API_TOKEN_LENGTH = 60;

    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token', 'google_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token', 'google_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token, $this->profile->language));
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }
}
