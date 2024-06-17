<?php

declare(strict_types=1);

namespace SmartDelivery\Order\UseCases;

interface CancelOrderUseCase
{
    public function handle(int $orderId): void;
}
