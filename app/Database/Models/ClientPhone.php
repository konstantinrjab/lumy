<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class ClientPhone extends Model
{
    protected $fillable = ['client_id', 'phone'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
