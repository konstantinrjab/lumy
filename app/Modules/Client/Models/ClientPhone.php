<?php

namespace App\Modules\Client\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientPhone extends \Eloquent
{
    protected $fillable = ['client_id', 'phone'];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
