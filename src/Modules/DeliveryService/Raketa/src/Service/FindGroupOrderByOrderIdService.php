<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Service;

use SmartDelivery\DeliveryService\Raketa\Entities\OrderGroupEntity;

interface FindGroupOrderByOrderIdService
{
    public function handle(int $orderId): ?OrderGroupEntity;
}
