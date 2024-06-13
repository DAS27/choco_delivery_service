<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Dto;

use Spatie\LaravelData\Data;

final class PointDto extends Data
{
    public function __construct(
        public string $phone_number,
        public AddressDto $address,
        /** @var ProductDto[] */
        public ?array $products,
        public ?int $merchant_order_id = null,
        public ?TaskDto $task = null,
    ) {}
}
