<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\SmartDeal\src\DTO;

use SmartDelivery\DeliveryService\Raketa\Enums\OrderStatusEnum;
use Spatie\LaravelData\Data;

final class OrderStatusDto extends Data
{
    public function __construct(
        public readonly string $order_id,
        public readonly string $warehouse_order_id,
        public readonly OrderStatusEnum $status
    ) {}
}
