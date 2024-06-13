<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Strategies\CreateOrderProcess\Impl;

use SmartDelivery\Order\Dto\RequestOrderDto;
use SmartDelivery\Order\Strategies\CreateOrderProcess\OrderProcessStrategy;

final class PlannedOrderProcessStrategy implements OrderProcessStrategy
{
    public function __construct(

    ) {}

    public function handle(RequestOrderDto $dto)
    {
        // TODO: Implement handle() method.
    }
}
