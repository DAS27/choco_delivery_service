<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Repositories;

use SmartDelivery\DeliveryService\Raketa\Dto\OrderGroupDto;
use SmartDelivery\DeliveryService\Raketa\Entities\OrderGroupEntity;

interface OrderGroupRepository
{
    public function store(OrderGroupDto $dto): ?OrderGroupEntity;

    public function findByOrderId(int $orderId): ?OrderGroupEntity;
}
