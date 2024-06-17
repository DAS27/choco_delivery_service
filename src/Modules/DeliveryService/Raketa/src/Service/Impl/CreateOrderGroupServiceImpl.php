<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Service\Impl;

use SmartDelivery\DeliveryService\Raketa\Dto\OrderGroupDto;
use SmartDelivery\DeliveryService\Raketa\Entities\OrderGroupEntity;
use SmartDelivery\DeliveryService\Raketa\Repositories\OrderGroupRepository;
use SmartDelivery\DeliveryService\Raketa\Service\CreateOrderGroupService;

final readonly class CreateOrderGroupServiceImpl implements CreateOrderGroupService
{
    public function __construct(
        private OrderGroupRepository $orderGroupRepository
    ) {}

    public function handle(OrderGroupDto $dto): ?OrderGroupEntity
    {
        return $this->orderGroupRepository->store($dto);
    }
}
