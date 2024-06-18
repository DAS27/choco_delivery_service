<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Dto;

use SmartDelivery\DeliveryService\Main\Enums\DeliveryServiceEnum;
use Spatie\LaravelData\Data;

final class CancelOrderDto extends Data
{
    public function __construct(
        public readonly int $order_id,
        public readonly DeliveryServiceEnum $service_name
    ) {}
}
