<?php

declare(strict_types=1);

namespace SmartDelivery\Order\UseCases;

use SmartDelivery\HttpClients\Raketa\Enums\OrderGroupStatusEnum;

interface UpdateOrderGroupStatusUseCase
{
    public function handle(int $orderId, OrderGroupStatusEnum $status): void;
}
