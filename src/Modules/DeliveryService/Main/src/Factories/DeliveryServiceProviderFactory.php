<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Main\Factories;

use SmartDelivery\DeliveryService\Main\Contracts\CreateOrderContract;
use SmartDelivery\DeliveryService\Main\Enums\DeliveryServiceEnum;
use SmartDelivery\DeliveryService\Main\Exceptions\UnknownDeliveryServiceTypeException;
use SmartDelivery\DeliveryService\Raketa\UseCases\Impl\RaketaOrderContractImpl;

final class DeliveryServiceProviderFactory
{
    /**
     * @throws UnknownDeliveryServiceTypeException
     */
    public function buildIssueContract(DeliveryServiceEnum $serviceEnum): CreateOrderContract
    {
        return match (true) {
            $serviceEnum === DeliveryServiceEnum::RAKETA => app()->make(RaketaOrderContractImpl::class),

            default => throw new UnknownDeliveryServiceTypeException('Unknown delivery service provider type: ' . $serviceEnum->value),
        };
    }
}
