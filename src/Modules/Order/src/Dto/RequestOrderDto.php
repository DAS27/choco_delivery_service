<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Dto;

use Spatie\LaravelData\Data;

final class RequestOrderDto extends Data
{
    public function __construct(
        public int $order_id,
        public int $merchant_id,
        public int $warehouse_order_id,
        public string $phone,
        public array $address,
        public string $delivery_service_name,
        public string $order_created_at,
        public string $total_amount,
        public array $products,
        public ?string $order_planned_at = null,
    ) {}
}
