<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class ClientEmail extends Model
{
    protected $fillable = ['client_id', 'email'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
