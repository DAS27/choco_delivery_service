<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\UseCases\Impl;

use SmartDelivery\DeliveryService\Main\Contracts\CancelOrderContract;
use SmartDelivery\DeliveryService\Main\Enums\DeliveryServiceEnum;
use SmartDelivery\Order\UseCases\CancelOrderUseCase;

final readonly class RaketaCancelOrderContractImpl implements CancelOrderContract
{
    public function __construct(
        private CancelOrderUseCase $cancelOrderUseCase
    ) {}

    /**
     * @inheritDoc
     */
    public function handle(int $orderId): void
    {
        $this->cancelOrderUseCase->handle($orderId);
    }

    public function getProvider(): DeliveryServiceEnum
    {
        return DeliveryServiceEnum::RAKETA;
    }
}
