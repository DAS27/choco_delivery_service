<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\ChocoDostavka\DTO;

use Spatie\LaravelData\Data;

final class ContactInfoDto extends Data
{
    public function __construct(
        public string $phone_number,
    ) {}
}
