<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryIntegration\SmartDeal\Entities;

use Spatie\LaravelData\Data;

final class OrderEntity extends Data
{
    public function __construct(
        public string $id,
        public string $phone,
        public string $point_a,
        public string $point_b,
        public string $planned_datetime,
        public string $external_order_id,
    ) {}
}
