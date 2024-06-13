<?php

namespace SmartDelivery\HttpClients\Raketa\Services\Impl;

use SmartDelivery\HttpClients\Raketa\DTO\AccessTokenDto;
use SmartDelivery\HttpClients\Raketa\Entities\AccessTokenEntity;
use SmartDelivery\HttpClients\Raketa\RaketaAuthHttpClientInterface;
use SmartDelivery\HttpClients\Raketa\Repositories\TokenStorageRepository;
use SmartDelivery\HttpClients\Raketa\Services\GetAccessTokenService;

final readonly class GetAccessTokenServiceImpl implements GetAccessTokenService
{
    private const EXPIRATION_TIME = 15552000; // 180 days (6 months)

    public function __construct(
        private TokenStorageRepository $tokenStorageRepository,
        private RaketaAuthHttpClientInterface $httpAuthClient
    ) {}

    public function handle(string $accessToken, string $refreshToken): AccessTokenEntity
    {
        $token = $this->tokenStorageRepository->get();
        if ($token === null) {
            $accessTokenResponse = $this->httpAuthClient->obtainAccessToken(
                new AccessTokenDto(
                    access_token: $accessToken, refresh_token: $refreshToken
                )
            );

            $newToken = new AccessTokenEntity(
                access_token: $accessTokenResponse->access, refresh_token: $accessTokenResponse->refresh
            );

            $this->tokenStorageRepository->set($newToken, self::EXPIRATION_TIME);
        }

        return $token;
    }
}
