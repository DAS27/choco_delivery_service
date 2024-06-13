<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Dto;

use SmartDelivery\HttpClients\Raketa\Enums\TransportTypeEnum;
use Spatie\LaravelData\Data;

final class CreateOrderDto extends Data
{
    public function __construct(
        public TransportTypeEnum $transportType,
        /** @var PointDto[] */
        public array $points,
        public ?string $callbackUrl = null,
        public ?string $orderPlannedAt = null
    ) {}
}
