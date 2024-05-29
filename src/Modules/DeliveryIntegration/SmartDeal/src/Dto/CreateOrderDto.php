<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryIntegration\SmartDeal\Dto;

use SmartDelivery\HttpClients\ChocoDostavka\DTO\AddressDto;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\ProductDto;
use Spatie\LaravelData\Data;

final class CreateOrderDto extends Data
{
    public function __construct(
        public string $phone,
        public AddressDto $point_a,
        public AddressDto $point_b,
        /** @var ProductDto[] */
        public array $products,
        public int $external_order_id,
        public ?string $planned_datetime = null,
    ) {}
}
