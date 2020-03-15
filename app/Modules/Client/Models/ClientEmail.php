<?php

namespace App\Modules\Client\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientEmail extends \Eloquent
{
    protected $fillable = ['client_id', 'email'];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
