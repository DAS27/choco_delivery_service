<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Strategies\CreateOrderProcess\Impl;

use SmartDelivery\Order\Dto\RequestOrderDto;
use SmartDelivery\Order\Strategies\CreateOrderProcess\OrderProcessStrategy;
use SmartDelivery\Order\UseCases\CreateOrderUseCase;

final readonly class PlannedOrderProcessStrategy implements OrderProcessStrategy
{
    public function __construct(
        private CreateOrderUseCase $createOrderUseCase
    ) {}

    public function handle(RequestOrderDto $dto): void
    {
        $this->createOrderUseCase->handle($dto);
    }
}
