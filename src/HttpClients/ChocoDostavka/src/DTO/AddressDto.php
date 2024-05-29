<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\ChocoDostavka\DTO;

use Spatie\LaravelData\Data;

final class AddressDto extends Data
{
    public function __construct(
        public string $street,
        public string $building,
        public ?string $extra_info = null
    ) {}
}
