<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Service\Impl;

use SmartDelivery\DeliveryService\Raketa\Entities\OrderGroupEntity;
use SmartDelivery\DeliveryService\Raketa\Repositories\OrderGroupRepository;
use SmartDelivery\DeliveryService\Raketa\Service\FindGroupOrderByOrderIdService;

final readonly class FindGroupOrderByOrderIdServiceServiceImpl implements FindGroupOrderByOrderIdService
{
    public function __construct(
        private OrderGroupRepository $orderGroupRepository
    ) {}

    public function handle(int $orderId): ?OrderGroupEntity
    {
        return $this->orderGroupRepository->findByOrderId($orderId);
    }
}
