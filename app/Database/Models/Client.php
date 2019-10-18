<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'user_id', 'name', 'surname', 'patronymic', 'comment'
    ];

    public function emails()
    {
        return $this->hasMany(ClientEmail::class);
    }
}
