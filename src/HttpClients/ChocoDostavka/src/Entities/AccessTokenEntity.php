<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\ChocoDostavka\Entities;

use Spatie\LaravelData\Data;

final class AccessTokenEntity extends Data
{
    public function __construct(
        public string $access_token,
        public string $refresh_token
    ) {}
}
