<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\Raketa;

use Psr\Http\Message\ResponseInterface;
use SmartDelivery\DeliveryService\Raketa\Dto\CreateOrderDto;
use SmartDelivery\HttpClients\Raketa\DTO\AccessTokenDto;
use SmartDelivery\HttpClients\Raketa\Responses\OrderGroupResponse;
use SmartDelivery\HttpClients\Raketa\Responses\OrderResponse;
use SmartDelivery\HttpClients\Raketa\Responses\GetAccessTokenResponse;

interface RaketaHttpClientInterface
{
    public function getHeaders(): array;

    public function validateResponse(ResponseInterface $response): void;

    public function obtainAccessToken(AccessTokenDto $accessTokenDto): GetAccessTokenResponse;

    public function createOrder(CreateOrderDto $createOrderDto): OrderGroupResponse;

    public function getOrderDetail(string $orderId): OrderResponse;

    public function cancelOrder(string $orderId): void;

}
