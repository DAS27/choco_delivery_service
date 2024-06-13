<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Models;

use SmartDelivery\Main\Models\AbstractModel;

/**
 * @property string $order_id
 * @property string $warehouse_order_id
 * @property string $phone
 * @property array $address
 * @property string $delivery_service_name
 * @property string $order_planned_at
 * @property string $order_created_at
 * @property string $total_amount
 * @property array $products
 */
final class RaketaModel extends AbstractModel
{
    protected $table = 'raketa_orders';

    protected $fillable = [
        'order_id',
        'warehouse_order_id',
        'phone',
        'address',
        'delivery_service_name',
        'order_planned_at',
        'order_created_at',
        'total_amount',
        'products',
    ];

    protected $casts = [
        'address' => 'array',
        'products' => 'array',
    ];
}
