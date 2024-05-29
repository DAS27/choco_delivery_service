<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryIntegration\SmartDeal\Models;

use SmartDelivery\Main\Models\AbstractModel;


/**
 * @property string $id
 * @property string $phone
 * @property string $point_a
 * @property string $point_b
 * @property string $products
 * @property string planned_datetime
 * @property string $external_order_id
 */
final class SmartDealModel extends AbstractModel
{
    protected $table = 'smart_deal_orders';

    protected $fillable = [
        'point_a',
        'point_b',
        'products',
        'phone',
        'planned_datetime',
        'external_order_id',
    ];
}
