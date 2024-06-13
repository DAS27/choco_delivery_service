<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Main\Contracts;

use SmartDelivery\DeliveryService\Main\Contracts\Exceptions\CreateExternalOrderException;
use SmartDelivery\DeliveryService\Main\Dto\CreateExternalOrderDto;
use SmartDelivery\DeliveryService\Main\Enums\DeliveryServiceEnum;

interface CreateOrderContract
{
    /**
     * @throws CreateExternalOrderException
     */
    public function handle(CreateExternalOrderDto $externalOrderDto): void;

    public function getProvider(): DeliveryServiceEnum;
}
