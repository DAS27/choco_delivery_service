<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\Raketa\Responses;

final class OrderResponse
{
    public function __construct(
        public int $id,
        public string $status,
        public string $price,
        public ?int $sms_code,
        public ?int $merchant_order_id,
        public ?string $tracking_short_link,
        public string $tracking_uuid,
        public ?string $courier_name,
        public ?string $courier_phone,
        public ?bool $was_returned,
    ) {}
}
