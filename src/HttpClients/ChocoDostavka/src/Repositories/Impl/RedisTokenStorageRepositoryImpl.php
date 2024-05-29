<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\ChocoDostavka\Repositories\Impl;

use Predis\Client;
use SmartDelivery\HttpClients\ChocoDostavka\Entities\AccessTokenEntity;
use SmartDelivery\HttpClients\ChocoDostavka\Repositories\TokenStorageRepository;
use SmartDelivery\Main\Exceptions\CantFindException;
use SmartDelivery\Main\Exceptions\CantStoreException;
use Throwable;

final class RedisTokenStorageRepositoryImpl implements TokenStorageRepository
{
    private const CACHE_ACCESS_TOKEN_PREFIX = 'choco_dostavka_access_token';

    public function __construct(
        private readonly Client $client
    ) {}

    public function set(AccessTokenEntity $accessToken, int $willExpireInSeconds): void
    {
        try {
            $data = ['jwt_token' => $accessToken];
            $value = json_encode($data);
            $this->client->setex(self::CACHE_ACCESS_TOKEN_PREFIX, $willExpireInSeconds, $value);
        } catch (Throwable $e) {
            throw new CantStoreException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function get(): ?AccessTokenEntity
    {
        try {
            $value = $this->client->get(self::CACHE_ACCESS_TOKEN_PREFIX);
            if ($value === null) {
                return null;
            }

            $data = json_decode($value, true);

            return AccessTokenEntity::from($data['jwt_token']);
        } catch (Throwable $e) {
            throw new CantFindException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
