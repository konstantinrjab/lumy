<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    public const VISIBILITY_VISIBLE = 1;
    public const VISIBILITY_HIDDEN = 0;

    protected $fillable = [
        'user_id', 'name', 'surname', 'patronymic', 'comment', 'visibility'
    ];

    public function emails(): HasMany
    {
        return $this->hasMany(ClientEmail::class);
    }

    public function phones(): HasMany
    {
        return $this->hasMany(ClientPhone::class);
    }
}
