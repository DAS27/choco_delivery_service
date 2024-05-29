<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryIntegration\ChocoDostavka\Service;

use SmartDelivery\DeliveryIntegration\ChocoDostavka\Entities\OrderEntity;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\CreateOrderDto;

interface CreateOrderService
{
    public function handle(CreateOrderDto $dto): OrderEntity;
}
