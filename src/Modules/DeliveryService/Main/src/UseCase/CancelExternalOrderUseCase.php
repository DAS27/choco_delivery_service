<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Main\UseCase;

use SmartDelivery\Order\Dto\CancelOrderDto;

interface CancelExternalOrderUseCase
{
    public function handle(CancelOrderDto $dto): void;
}
