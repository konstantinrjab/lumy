<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $user_id
 * @property int $client_id
 * @property string $status
 * @property string $title
 * @property string $address
 * @property float $price
 * @property string $currency
 * @property float $prepay_price
 * @property string $prepay_currency
 * @property string $start
 * @property string $end
 * @property string $deadline
 * @property string $comment
 */
class Deal extends Model
{
    protected $fillable = [
        'user_id',
        'client_id',
        'status',
        'title',
        'address',
        'price',
        'currency',
        'prepay_price',
        'prepay_currency',
        'start',
        'end',
        'deadline',
        'comment'
    ];

    protected $dates = [
        'start', 'end', 'deadline'
    ];

    public function facilities(): HasMany
    {
        return $this->hasMany(DealFacility::class);
    }
}
