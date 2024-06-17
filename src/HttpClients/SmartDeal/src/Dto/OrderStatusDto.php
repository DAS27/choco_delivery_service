<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\SmartDeal\Dto;

use Spatie\LaravelData\Data;

final class OrderStatusDto extends Data
{
    public function __construct(
        public readonly int $order_id,
    ) {}
}
