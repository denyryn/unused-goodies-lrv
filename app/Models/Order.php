<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'address_id',
        'status',
        'total_amount',
    ];

    /**
     * Get the payment associated with the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Payment()
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * The order items that belong to the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function OrderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * The user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => OrderStatusEnum::class,
        ];
    }
}
