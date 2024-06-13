<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\Raketa;

use SmartDelivery\HttpClients\Raketa\DTO\AccessTokenDto;
use SmartDelivery\HttpClients\Raketa\Responses\GetAccessTokenResponse;

interface RaketaAuthHttpClientInterface
{
    public function obtainAccessToken(AccessTokenDto $accessTokenDto): GetAccessTokenResponse;
}
