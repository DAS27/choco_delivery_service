<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\SmartDeal\Dto;

use SmartDelivery\DeliveryService\Main\Enums\DeliveryServiceEnum;
use SmartDelivery\DeliveryService\Raketa\Enums\OrderStatusEnum;
use Spatie\LaravelData\Data;

final class OrderStatusDto extends Data
{
    public function __construct(
        public readonly int $order_id,
        public readonly int $external_order_id,
        public readonly int $warehouse_order_id,
        public DeliveryServiceEnum $delivery_service_name,
        public readonly OrderStatusEnum $status
    ) {}
}
