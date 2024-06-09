<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Repositories;

use SmartDelivery\DeliveryService\Raketa\Dto\CreateOrderDto;
use SmartDelivery\DeliveryService\Raketa\Entities\OrderEntity;

interface CreateOrderRepository
{
    public function store(CreateOrderDto $dto): OrderEntity;
}
