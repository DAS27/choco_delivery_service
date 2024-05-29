<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\ChocoDostavka\Responses;

use Spatie\LaravelData\Data;

final class GetAccessTokenResponse extends Data
{
    public function __construct(
        public string $access,
        public string $refresh
    ) {}
}
