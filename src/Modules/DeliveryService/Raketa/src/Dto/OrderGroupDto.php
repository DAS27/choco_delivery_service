<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Dto;

use SmartDelivery\DeliveryService\Raketa\Enums\OrderGroupStatusEnum;
use Spatie\LaravelData\Data;

final class OrderGroupDto extends Data
{
    public function __construct(
        public readonly int $order_id,
        public readonly int $external_order_id,
        public readonly OrderGroupStatusEnum $status,
    ) {}
}
