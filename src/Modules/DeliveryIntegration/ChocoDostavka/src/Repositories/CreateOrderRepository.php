<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryIntegration\ChocoDostavka\Repositories;

use SmartDelivery\HttpClients\ChocoDostavka\DTO\CreateOrderDto;
use SmartDelivery\DeliveryIntegration\ChocoDostavka\Entities\OrderEntity;

interface CreateOrderRepository
{
    public function store(CreateOrderDto $dto): OrderEntity;
}
