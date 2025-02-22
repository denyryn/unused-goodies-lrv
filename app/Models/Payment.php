<?php

namespace App\Models;

use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'transaction_id',
        'payment_method',
        'payment_status',
    ];

    /**
     * Get the order that this payment belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Order()
    {
        return $this->hasOne(Order::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'payment_method' => PaymentMethodEnum::class,
            'payment_status' => PaymentStatusEnum::class,
        ];
    }
}
