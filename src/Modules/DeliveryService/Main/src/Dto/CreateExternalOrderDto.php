<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Main\Dto;

use SmartDelivery\DeliveryService\Main\Enums\DeliveryServiceEnum;
use SmartDelivery\DeliveryService\Raketa\Dto\AddressDto;
use SmartDelivery\DeliveryService\Raketa\Dto\ProductDto;
use Spatie\LaravelData\Data;

final class CreateExternalOrderDto extends Data
{
    public function __construct(
        public int $external_order_id,
        public int $warehouse_order_id,
        public string $phone,
        public AddressDto $address,
        public DeliveryServiceEnum $serviceEnum,
        public string $order_created_at,
        /** @var ProductDto[] */
        public array $products,
        public ?string $total_amount,
        public ?string $order_planned_at = null,
    ) {}
}
