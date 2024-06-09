<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Repositories;

use SmartDelivery\Order\Dto\CreateOrderDto;
use SmartDelivery\Order\Entities\OrderEntity;

interface CreateOrderRepository
{
    public function store(CreateOrderDto $dto): ?OrderEntity;
}
