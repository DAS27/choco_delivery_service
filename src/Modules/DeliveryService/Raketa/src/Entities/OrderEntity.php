<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Entities;

use SmartDelivery\HttpClients\Raketa\Enums\OrderStatusEnum;
use Spatie\LaravelData\Data;

final class OrderEntity extends Data
{
    public function __construct(
        public string $id,
        public string $external_id,
        public OrderStatusEnum $status,
        public string $price,
        public string $tracking_uuid,
        public string $tracking_short_link,
        public string $courier_name,
        public string $courier_phone,
        public int $sms_code,
        public bool $was_returned,
    ) {}
}
