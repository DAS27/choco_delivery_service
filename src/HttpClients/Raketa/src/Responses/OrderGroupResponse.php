<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\Raketa\Responses;

use SmartDelivery\HttpClients\Raketa\Enums\OrderGroupStatusEnum;

final class OrderGroupResponse
{
    public function __construct(
        public int $group_id,
        public OrderGroupStatusEnum $status,
    ) {}
}
