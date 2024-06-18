<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Main\Contracts;

use SmartDelivery\DeliveryService\Main\Enums\DeliveryServiceEnum;
use SmartDelivery\DeliveryService\Main\Exceptions\CantCancelOrderException;
use SmartDelivery\Order\Dto\CancelOrderDto;

interface CancelOrderContract
{
    /**
     * @throws CantCancelOrderException
     */
    public function handle(CancelOrderDto $dto): void;

    public function getProvider(): DeliveryServiceEnum;
}
