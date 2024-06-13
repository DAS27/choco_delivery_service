<?php

namespace SmartDelivery\HttpClients\Raketa\Services;

use SmartDelivery\HttpClients\Raketa\Entities\AccessTokenEntity;

interface GetAccessTokenService
{
    public function handle(
        string $accessToken,
        string $refreshToken
    ): ?AccessTokenEntity;
}
