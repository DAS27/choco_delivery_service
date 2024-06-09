<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Service\Impl;

use SmartDelivery\DeliveryService\Raketa\Repositories\CreateOrderRepository;
use SmartDelivery\DeliveryService\Raketa\Service\CreateOrderService;
use SmartDelivery\DeliveryService\Raketa\Entities\OrderEntity;
use SmartDelivery\DeliveryService\Raketa\Dto\CreateOrderDto;

final readonly class CreateOrderServiceImpl implements CreateOrderService
{
    public function __construct(
        private CreateOrderRepository $createOrderRepository
    ) {}

    public function handle(CreateOrderDto $dto): ?OrderEntity
    {
        return $this->createOrderRepository->store($dto);
    }
}
