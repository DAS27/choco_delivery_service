<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Main\Contracts;

use SmartDelivery\DeliveryService\Main\Contracts\Dto\CreateOrderRequestDto;
use SmartDelivery\DeliveryService\Main\Contracts\Dto\CreateOrderResponseDto;
use SmartDelivery\DeliveryService\Main\Contracts\Exceptions\CreateOrderException;
use SmartDelivery\Order\Enums\OrderProviderEnum;

interface CreateOrderContract
{
    /**
     * @throws CreateOrderException
     */
    public function handle(CreateOrderRequestDto $request): CreateOrderResponseDto;

    public function getProvider(): OrderProviderEnum;
}
