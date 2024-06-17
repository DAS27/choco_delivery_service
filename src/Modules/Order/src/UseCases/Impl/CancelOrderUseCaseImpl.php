<?php

declare(strict_types=1);

namespace SmartDelivery\Order\UseCases\Impl;

use SmartDelivery\HttpClients\Raketa\RaketaHttpClientInterface;
use SmartDelivery\Order\UseCases\CancelOrderUseCase;

final readonly class CancelOrderUseCaseImpl implements CancelOrderUseCase
{
    public function __construct(
        private RaketaHttpClientInterface $httpClient
    ) {}

    public function handle(int $orderId): void
    {
        $this->httpClient->cancelOrder($orderId);
    }
}
