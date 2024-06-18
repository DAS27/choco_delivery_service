<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Main\Contracts;

use SmartDelivery\DeliveryService\Main\Enums\DeliveryServiceEnum;
use SmartDelivery\DeliveryService\Main\Exceptions\CantCancelOrderException;

interface CancelOrderContract
{
    /**
     * @throws CantCancelOrderException
     */
    public function handle(int $orderId): void;

    public function getProvider(): DeliveryServiceEnum;
}
