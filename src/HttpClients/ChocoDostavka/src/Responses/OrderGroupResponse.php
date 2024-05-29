<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\ChocoDostavka\Responses;

use SmartDelivery\HttpClients\ChocoDostavka\Enums\OrderGroupStatusEnum;

final class OrderGroupResponse
{
    public function __construct(
        public int $group_id,
        public OrderGroupStatusEnum $status,
        /** @var OrderResponse[] */
        public array $orders
    ) {}
}
