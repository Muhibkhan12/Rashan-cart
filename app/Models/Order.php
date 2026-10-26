<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/*
| orders table: id, order_number, user_id, address_id, delivery_address, delivery_area,
|               subtotal, delivery_fee, total_amount, status, created_at, updated_at
*/
class Order extends Model
{
    public const PLACED           = 'Placed';
    public const CONFIRMED        = 'Confirmed';
    public const PACKED           = 'Packed';
    public const OUT_FOR_DELIVERY = 'Out for delivery';
    public const DELIVERED        = 'Delivered';
    public const CANCELLED        = 'Cancelled';

    protected $fillable = [
        'order_number',
        'user_id',
        'address_id',
        'delivery_address',
        'delivery_area',
        'subtotal',
        'delivery_fee',
        'total_amount',
        'status',
    ];

    protected $casts = [
        'subtotal'     => 'decimal:2',
        'delivery_fee' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    /** A customer can cancel only while the order is still "Placed". */
    public function isCancellable(): bool
    {
        return $this->status === self::PLACED;
    }
}