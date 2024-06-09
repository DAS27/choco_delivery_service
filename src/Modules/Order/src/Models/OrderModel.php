<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use SmartDelivery\Main\Models\AbstractStringableModel;
use SmartDelivery\Order\Enums\OrderStatusEnum;
use SmartDelivery\DeliveryService\Main\Models\DeliveryServiceModel;

/**
 * @property string $id
 * @property string $merchant_id
 * @property string $external_order_id
 * @property string $delivery_service_id
 * @property string $delivery_address
 * @property string $warehouse_type
 * @property string $phone
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
        'delivery_service_id',
        'delivery_address',
        'warehouse_type',
        'phone',
        'scheduled_delivery_time',
        'status',
        'total_amount',
    ];

    protected $casts = [
        'delivery_address' => 'array',
        'status' => OrderStatusEnum::class
    ];

    public function deliveryService(): BelongsTo
    {
        return $this->belongsTo(DeliveryServiceModel::class);
    }
}
