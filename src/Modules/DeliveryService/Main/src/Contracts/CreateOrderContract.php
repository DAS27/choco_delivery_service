<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Main\Contracts;

use SmartDelivery\DeliveryService\Main\Contracts\Dto\CreateOrderResponseDto;
use SmartDelivery\DeliveryService\Main\Contracts\Exceptions\CreateOrderException;
use SmartDelivery\DeliveryService\Main\Dto\CreateExternalOrderDto;
use SmartDelivery\DeliveryService\Main\Enums\DeliveryServiceEnum;

interface CreateOrderContract
{
    /**
     * @throws CreateOrderException
     */
    public function handle(CreateExternalOrderDto $externalOrderDto): CreateOrderResponseDto;

    public function getProvider(): DeliveryServiceEnum;
}
