<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryIntegration\SmartDeal\Service;

use SmartDelivery\DeliveryIntegration\SmartDeal\Dto\CreateOrderDto;
use SmartDelivery\DeliveryIntegration\SmartDeal\Entities\OrderEntity;

interface CreateOrderService
{
    public function handle(CreateOrderDto $dto): OrderEntity;
}
