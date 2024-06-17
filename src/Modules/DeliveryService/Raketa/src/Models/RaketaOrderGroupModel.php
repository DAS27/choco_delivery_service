<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Models;

use SmartDelivery\DeliveryService\Raketa\Enums\OrderGroupStatusEnum;
use SmartDelivery\Main\Models\AbstractStringableModel;

/**
 * @property string $order_id
 * @property string $external_order_id
 * @property string $status
 */
final class RaketaOrderGroupModel extends AbstractStringableModel
{
    protected $table = 'raketa_order-groups';

    protected $fillable = [
        'order_id',
        'external_order_id',
        'status'
    ];

    protected $casts = [
        'status' => OrderGroupStatusEnum::class,
    ];
}
