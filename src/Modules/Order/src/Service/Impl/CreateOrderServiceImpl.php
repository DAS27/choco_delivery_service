<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Service\Impl;

use SmartDelivery\Order\Dto\CreateOrderDto;
use SmartDelivery\Order\Entities\OrderEntity;
use SmartDelivery\Order\Repositories\CreateOrderRepository;
use SmartDelivery\Order\Service\CreateOrderService;

final readonly class CreateOrderServiceImpl implements CreateOrderService
{
    public function __construct(
        private CreateOrderRepository $createOrderRepository
    ) {}

    public function handle(CreateOrderDto $dto): OrderEntity
    {
        return $this->createOrderRepository->store($dto);
    }
}
