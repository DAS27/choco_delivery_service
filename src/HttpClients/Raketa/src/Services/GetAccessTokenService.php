<?php

namespace SmartDelivery\HttpClients\Raketa\Services;

interface GetAccessTokenService
{
    public function handle(
        string $accessToken,
        string $refreshToken
    ): string;
}
