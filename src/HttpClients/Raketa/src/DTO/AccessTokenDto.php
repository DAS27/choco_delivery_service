<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\Raketa\DTO;

use Spatie\LaravelData\Data;

final class AccessTokenDto extends Data
{
    public function __construct(
        public string $access_token,
        public string $refresh_token
    ) {}
}
