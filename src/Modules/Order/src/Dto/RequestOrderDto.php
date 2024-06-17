<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Dto;

use Spatie\LaravelData\Data;

final class RequestOrderDto extends Data
{
    public function __construct(
        public int $order_id,
        public string $merchant_name,
        public int $warehouse_order_id,
        public string $recipient_phone,
        public string $sender_phone,
        public array $delivery_address,
        public string $delivery_service_name,
        public string $order_created_at,
        public string $total_amount,
        public array $items,
        public ?string $order_planned_at = null,
    ) {}
}
