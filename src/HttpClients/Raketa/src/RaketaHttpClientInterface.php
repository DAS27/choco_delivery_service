<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\Raketa;

use SmartDelivery\DeliveryService\Raketa\Dto\CreateOrderDto;
use SmartDelivery\HttpClients\Raketa\Responses\OrderGroupResponse;

interface RaketaHttpClientInterface
{
    public function createOrder(CreateOrderDto $createOrderDto): OrderGroupResponse;

    public function cancelOrder(int $orderId): void;

}
