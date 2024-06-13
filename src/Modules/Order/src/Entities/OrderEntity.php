<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Entities;

use SmartDelivery\DeliveryService\Main\Enums\DeliveryServiceEnum;
use SmartDelivery\DeliveryService\Raketa\Dto\AddressDto;
use SmartDelivery\Order\Enums\OrderStatusEnum;
use Spatie\LaravelData\Data;

final class OrderEntity extends Data
{
    public function __construct(
        public readonly string $id,
        public readonly int $merchant_id,
        public readonly int $external_order_id,
        public readonly DeliveryServiceEnum $delivery_service_name,
        public readonly AddressDto $address,
        public readonly string $phone,
        public readonly OrderStatusEnum $status,
        public readonly string $total_amount,
        public readonly ?string $scheduled_delivery_time = null,
    ) {}
}
