<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\ChocoDostavka\DTO;

use Spatie\LaravelData\Data;

final class ProductDto extends Data
{
    public function __construct(
        public string $title,
        public int $price,
        public int $count,
    ) {}
}
