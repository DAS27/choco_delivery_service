<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Service;

use SmartDelivery\DeliveryService\Raketa\Entities\OrderEntity;
use SmartDelivery\DeliveryService\Raketa\Dto\CreateOrderDto;

interface CreateOrderService
{
    public function handle(CreateOrderDto $dto): ?OrderEntity;
}
