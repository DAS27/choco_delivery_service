<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\Raketa;

use SmartDelivery\DeliveryService\Raketa\Dto\CreateOrderDto;
use SmartDelivery\HttpClients\Raketa\Responses\OrderGroupResponse;
use SmartDelivery\HttpClients\Raketa\Responses\OrderResponse;

interface RaketaHttpClientInterface
{
    public function createOrder(CreateOrderDto $createOrderDto): OrderGroupResponse;

    public function getOrderDetail(string $orderId): OrderResponse;

    public function cancelOrder(string $orderId): void;

}
