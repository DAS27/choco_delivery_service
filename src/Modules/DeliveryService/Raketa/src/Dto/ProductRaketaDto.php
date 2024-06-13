<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Dto;

use SmartDelivery\DeliveryService\Main\Dto\WarehouseTypeEnum;
use Spatie\LaravelData\Data;

final class ProductRaketaDto extends Data
{
    public function __construct(
        public string $title,
        public int $price,
        public int $count,
        public AddressDto $address,
        public WarehouseTypeEnum $warehouse_type
    ) {}
}
