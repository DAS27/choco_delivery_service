<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryIntegration\SmartDeal\Service\Impl;

use SmartDelivery\DeliveryIntegration\SmartDeal\Dto\CreateOrderDto;
use SmartDelivery\DeliveryIntegration\SmartDeal\Entities\OrderEntity;
use SmartDelivery\DeliveryIntegration\SmartDeal\Repositories\CreateOrderRepository;
use SmartDelivery\DeliveryIntegration\SmartDeal\Service\CreateOrderService;

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
