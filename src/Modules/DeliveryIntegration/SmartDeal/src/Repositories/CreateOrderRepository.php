<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryIntegration\SmartDeal\Repositories;

use SmartDelivery\DeliveryIntegration\SmartDeal\Dto\CreateOrderDto;
use SmartDelivery\DeliveryIntegration\SmartDeal\Entities\OrderEntity;

interface CreateOrderRepository
{
    public function store(CreateOrderDto $dto): OrderEntity;
}
