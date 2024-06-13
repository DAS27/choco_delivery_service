<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use SmartDelivery\Main\Models\AbstractStringableModel;

/**
 * @property string $id
 * @property int $order_id
 * @property string $warehouse_order_id
 * @property string $pickup_address
 * @property string $title
 * @property int $quantity
 * @property string $price
 * @property string $comments
 */
final class OrderItemModel extends AbstractStringableModel
{
    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'warehouse_order_id',
        'pickup_address',
        'title',
        'quantity',
        'price',
        'comments',
    ];

    protected $casts = [
        'pickup_address' => 'array',
        'comments' => 'array',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(OrderModel::class);
    }
}
