<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Repositories;

use SmartDelivery\Order\Dto\RequestOrderDto;
use SmartDelivery\Order\Entities\OrderEntity;

interface OrderRepository
{
    public function store(RequestOrderDto $dto): OrderEntity;
}
