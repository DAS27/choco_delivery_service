<?php

declare(strict_types=1);

namespace SmartDelivery\Order\UseCases\Impl;

use SmartDelivery\HttpClients\Raketa\Enums\OrderGroupStatusEnum;
use SmartDelivery\Order\UseCases\UpdateOrderGroupStatusUseCase;

final class UpdateOrderGroupStatusUseCaseUseCaseImpl implements UpdateOrderGroupStatusUseCase
{
    public function __construct(

    ) {}

    public function handle(int $orderId, OrderGroupStatusEnum $status): void
    {
        // TODO: Implement handle() method.
    }
}
