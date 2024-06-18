<?php

declare(strict_types=1);

namespace SmartDelivery\Order\UseCases\Impl;

use SmartDelivery\DeliveryService\Main\UseCase\CancelExternalOrderUseCase;
use SmartDelivery\Order\Dto\CancelOrderDto;
use SmartDelivery\Order\UseCases\CancelOrderUseCase;

final readonly class CancelOrderUseCaseImpl implements CancelOrderUseCase
{
    public function __construct(
        private CancelExternalOrderUseCase $cancelExternalOrderUseCase
    ) {}

    public function handle(CancelOrderDto $dto): void
    {
        $this->cancelExternalOrderUseCase->handle($dto);
    }
}
