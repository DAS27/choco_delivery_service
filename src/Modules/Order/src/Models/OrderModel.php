<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use SmartDelivery\DeliveryService\Main\Enums\DeliveryServiceEnum;
use SmartDelivery\Main\Models\AbstractStringableModel;
use SmartDelivery\Order\Enums\OrderStatusEnum;

/**
 * @property string $id
 * @property string $merchant_name
 * @property int $external_order_id
 * @property string $delivery_service_name
 * @property string $delivery_address
 * @property string $warehouse_type
 * @property string $recipient_phone
 * @property string $sender_phone
 * @property string $scheduled_delivery_time
 * @property string $status
 * @property string $total_amount
 */
final class OrderModel extends AbstractStringableModel
{
    protected $table = 'orders';

    protected $fillable = [
        'id',
        'merchant_id',
        'external_order_id',
        'delivery_service_name',
        'delivery_address',
        'phone',
        'scheduled_delivery_time',
        'status',
        'total_amount',
    ];

    protected $casts = [
        'delivery_address' => 'array',
        'delivery_service_name' => DeliveryServiceEnum::class,
        'status' => OrderStatusEnum::class
    ];


    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItemModel::class);
    }
}
