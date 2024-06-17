<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Service;

use SmartDelivery\DeliveryService\Raketa\Dto\OrderGroupDto;
use SmartDelivery\DeliveryService\Raketa\Entities\OrderGroupEntity;

interface CreateOrderGroupService
{
    public function handle(OrderGroupDto $dto): ?OrderGroupEntity;
}
