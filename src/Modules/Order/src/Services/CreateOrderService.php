<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Services;

use SmartDelivery\Order\Dto\RequestOrderDto;

interface CreateOrderService
{
    public function handle(RequestOrderDto $dto): void;
}
