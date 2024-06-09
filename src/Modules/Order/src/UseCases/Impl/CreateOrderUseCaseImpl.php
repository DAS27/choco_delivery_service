<?php

declare(strict_types=1);

namespace SmartDelivery\Order\UseCases\Impl;

use SmartDelivery\DeliveryService\Main\Dto\CreateExternalOrderDto;
use SmartDelivery\DeliveryService\Main\UseCase\CreateExternalOrderUseCase;
use SmartDelivery\Order\Dto\CreateOrderDto;
use SmartDelivery\Order\UseCases\CreateOrderUseCase;

final readonly class CreateOrderUseCaseImpl implements CreateOrderUseCase
{
    public function __construct(
        private CreateExternalOrderUseCase $createExternalOrderUseCase
    ) {}

    public function handle(CreateOrderDto $dto): void
    {
        $this->createExternalOrderUseCase->handle(
            new CreateExternalOrderDto()
        );
    }
}
