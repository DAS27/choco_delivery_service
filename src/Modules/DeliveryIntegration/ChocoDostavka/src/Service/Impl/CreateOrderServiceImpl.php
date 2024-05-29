<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryIntegration\ChocoDostavka\Service\Impl;

use SmartDelivery\DeliveryIntegration\ChocoDostavka\Repositories\CreateOrderRepository;
use SmartDelivery\DeliveryIntegration\ChocoDostavka\Service\CreateOrderService;
use SmartDelivery\DeliveryIntegration\ChocoDostavka\Entities\OrderEntity;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\CreateOrderDto;

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
