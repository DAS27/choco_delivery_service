<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Service;


use SmartDelivery\Order\Dto\CreateOrderDto;
use SmartDelivery\Order\Entities\OrderEntity;

interface CreateOrderService
{
    public function handle(CreateOrderDto $dto): OrderEntity;
}
