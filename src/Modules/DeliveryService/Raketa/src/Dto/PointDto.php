<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Dto;

use Spatie\LaravelData\Data;

final class PointDto extends Data
{
    public function __construct(
        public ContactInfoDto $contact_info,
        public AddressDto $address,
        /** @var ProductDto[] */
        public ?array $items = null,
        public ?int $merchant_order_id = null,
        public ?TaskDto $tasks = null,
    ) {}
}
