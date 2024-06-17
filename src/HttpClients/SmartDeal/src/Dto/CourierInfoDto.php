<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\SmartDeal\Dto;

use SmartDelivery\DeliveryService\Main\Enums\DeliveryServiceEnum;

final class CourierInfoDto
{
    public function __construct(
        public readonly int $order_id,
        public readonly int $external_order_id,
        public DeliveryServiceEnum $delivery_service_name
    ) {}
}
