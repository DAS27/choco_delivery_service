<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\ChocoDostavka\Repositories;

use SmartDelivery\HttpClients\ChocoDostavka\Entities\AccessTokenEntity;
use SmartDelivery\Main\Exceptions\CantFindException;
use SmartDelivery\Main\Exceptions\CantStoreException;

interface TokenStorageRepository
{
    /** @throws CantStoreException */
    public function set(AccessTokenEntity $accessToken, int $willExpireInSeconds): void;

    /** @throws CantFindException */
    public function get(): ?AccessTokenEntity;
}
