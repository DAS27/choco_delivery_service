<?php

namespace SmartDelivery\HttpClients\ChocoDostavka\Services;

interface GetAccessTokenService
{
    public function handle(
        string $accessToken,
        string $refreshToken
    ): string;
}
