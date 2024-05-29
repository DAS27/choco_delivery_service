<?php

namespace SmartDelivery\HttpClients\ChocoDostavka\Services\Impl;

use SmartDelivery\HttpClients\ChocoDostavka\ChocoDostavkaHttpClient;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\AccessTokenDto;
use SmartDelivery\HttpClients\ChocoDostavka\Entities\AccessTokenEntity;
use SmartDelivery\HttpClients\ChocoDostavka\Repositories\TokenStorageRepository;
use SmartDelivery\HttpClients\ChocoDostavka\Services\GetAccessTokenService;

final readonly class GetAccessTokenServiceImpl implements GetAccessTokenService
{
    private const EXPIRATION_TIME = 15552000; // 180 days (6 months)

    public function __construct(
        private TokenStorageRepository $tokenStorageRepository,
        private ChocoDostavkaHttpClient $httpClient
    ) {}

    public function handle(string $accessToken, string $refreshToken): string
    {
        $token = $this->tokenStorageRepository->get();
        if ($token === null) {
            $accessTokenResponse  = $this->httpClient->obtainAccessToken(new AccessTokenDto($refreshToken));
            $newToken = new AccessTokenEntity(
                access_token: $accessTokenResponse->access,
                refresh_token: $accessTokenResponse->refresh
            );

            $this->tokenStorageRepository->set($newToken, self::EXPIRATION_TIME);
        }

        return $token->access_token;
    }
}
