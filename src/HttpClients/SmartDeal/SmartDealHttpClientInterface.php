<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\SmartDeal;

use SmartDelivery\HttpClients\SmartDeal\src\DTO\OrderStatusDto;

interface SmartDealHttpClientInterface
{
    public function sendOrderStatus(OrderStatusDto $dto): void;
}
