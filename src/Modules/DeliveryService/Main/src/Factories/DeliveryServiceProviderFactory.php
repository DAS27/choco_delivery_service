<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Main\Factories;

use SmartDelivery\DeliveryService\Raketa\UseCases\Impl\RaketaOrderContractImpl;
use SmartDelivery\DeliveryService\Main\Contracts\CreateOrderContract;
use SmartDelivery\DeliveryService\Main\Exceptions\UnknownDeliveryServiceTypeException;
use SmartDelivery\Order\Enums\OrderProviderEnum;

final class DeliveryServiceProviderFactory
{
    /**
     * @throws UnknownDeliveryServiceTypeException
     */
    public function buildIssueContract(OrderProviderEnum $orderProviderEnum): CreateOrderContract
    {
        return match (true) {
            $orderProviderEnum === OrderProviderEnum::RAKETA => app()->make(RaketaOrderContractImpl::class),

            default => throw new UnknownDeliveryServiceTypeException('Unknown delivery service provider type: ' . $orderProviderEnum->value),
        };
    }
}
