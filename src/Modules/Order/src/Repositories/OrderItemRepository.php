<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Repositories;

use SmartDelivery\Order\Dto\OrderItemDto;

interface OrderItemRepository
{
    public function store(OrderItemDto $dto): void;
}
