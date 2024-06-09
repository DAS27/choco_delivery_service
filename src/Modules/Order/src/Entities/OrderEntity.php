<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Entities;

use SmartDelivery\DeliveryService\Raketa\Dto\AddressDto;
use SmartDelivery\DeliveryService\Raketa\Dto\ProductDto;
use Spatie\LaravelData\Data;

final class OrderEntity extends Data
{
    public function __construct(
        public string $phone,
        public AddressDto $point_a,
        public AddressDto $point_b,
        /** @var ProductDto[] */
        public array $products,
        public int $external_order_id,
        public ?string $planned_datetime = null,
    ) {}
}
