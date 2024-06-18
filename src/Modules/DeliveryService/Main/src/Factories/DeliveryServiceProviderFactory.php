<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Main\Factories;

use SmartDelivery\DeliveryService\Main\Contracts\CreateOrderContract;
use SmartDelivery\DeliveryService\Main\Enums\DeliveryServiceEnum;
use SmartDelivery\DeliveryService\Main\Exceptions\UnknownDeliveryServiceTypeException;
use SmartDelivery\DeliveryService\Raketa\UseCases\Impl\RaketaCreateOrderContractImpl;

final class DeliveryServiceProviderFactory
{
    /**
     * @throws UnknownDeliveryServiceTypeException
     */
    public function buildCreateContract(DeliveryServiceEnum $serviceEnum): CreateOrderContract
    {
        return match (true) {
            $serviceEnum === DeliveryServiceEnum::RAKETA => app()->make(RaketaCreateOrderContractImpl::class),

            default => throw new UnknownDeliveryServiceTypeException('Unknown delivery service provider type: ' . $serviceEnum->value),
        };
    }

    public function buildCancelContract(int $orderId): void
    {
        return match (true) {
            $serviceEnum === DeliveryServiceEnum::RAKETA => app()->make(RaketaCreateOrderContractImpl::class),

            default => throw new UnknownDeliveryServiceTypeException('Unknown delivery service provider type: ' . $serviceEnum->value),
        };
    }
}
