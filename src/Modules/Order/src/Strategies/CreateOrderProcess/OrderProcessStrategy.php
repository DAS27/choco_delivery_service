<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Strategies\CreateOrderProcess;

use SmartDelivery\Order\Dto\RequestOrderDto;

interface OrderProcessStrategy
{
    public function handle(RequestOrderDto $dto);
}
