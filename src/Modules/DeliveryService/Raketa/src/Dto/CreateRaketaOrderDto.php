<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Dto;

use Spatie\LaravelData\Data;

final class CreateRaketaOrderDto extends Data
{
    public function __construct(
        public int $order_id,
        public int $warehouse_order_id,
        public string $phone,
        public AddressDto $address,
        public $delivery_service_name,
        public string $order_planned_at,
        public string $order_created_at,
        public string $total_amount,
        /** @var ProductDto[] */
        public array $products
    ) {}
}
