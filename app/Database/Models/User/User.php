<?php

namespace App\Database\Models\User;

use App\Database\Traits\HasRoles;
use App\Notifications\PasswordReset;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
    protected $fillable = ['name', 'email', 'password', 'api_token'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'api_token'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function social(): HasOne
    {
        return $this->hasOne(UsersSocial::class);
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new PasswordReset($token, $this->profile->language));
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }
}
