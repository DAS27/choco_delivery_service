<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\ChocoDostavka;

use Psr\Http\Message\ResponseInterface;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\AccessTokenDto;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\CreateOrderDto;
use SmartDelivery\HttpClients\ChocoDostavka\Responses\OrderGroupResponse;
use SmartDelivery\HttpClients\ChocoDostavka\Responses\OrderResponse;
use SmartDelivery\HttpClients\ChocoDostavka\Responses\GetAccessTokenResponse;

interface ChocoDostavkaHttpClientInterface
{
    public function getHeaders(): array;

    public function validateResponse(ResponseInterface $response): void;

    public function obtainAccessToken(AccessTokenDto $accessTokenDto): GetAccessTokenResponse;

    public function createOrder(CreateOrderDto $createOrderDto): OrderGroupResponse;

    public function getOrderDetail(string $orderId): OrderResponse;

    public function cancelOrder(string $orderId): void;

}
