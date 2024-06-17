<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\SmartDeal\Dto;

use SmartDelivery\DeliveryService\Raketa\Enums\OrderStatusEnum;
use Spatie\LaravelData\Data;

final class OrderStatusDto extends Data
{
    public function __construct(
        public readonly int $order_id,
        public readonly int $external_order_id,
        public readonly OrderStatusEnum $status,
        public readonly ?string $courier_name,
        public readonly ?string $courier_phone
    ) {}
}
