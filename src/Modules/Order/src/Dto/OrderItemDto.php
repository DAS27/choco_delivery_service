<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Dto;

use SmartDelivery\DeliveryService\Raketa\Dto\AddressDto;
use Spatie\LaravelData\Data;

final class OrderItemDto extends Data
{
    public function __construct(
        public readonly string $order_id,
        public readonly int $warehouse_order_id,
        public readonly AddressDto $address,
        public readonly string $title,
        public readonly int $quantity,
        public readonly string $price,
        public readonly ?string $comments = null,
    ) {}
}
