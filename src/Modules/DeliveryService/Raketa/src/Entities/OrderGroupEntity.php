<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Entities;

use Spatie\LaravelData\Data;

final class OrderGroupEntity extends Data
{
    public function __construct(
        public readonly int $order_id,
        public readonly int $external_order_id,
        public readonly string $status,
    ) {}
}
