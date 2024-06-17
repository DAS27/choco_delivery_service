<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\UseCases;

use SmartDelivery\HttpClients\SmartDeal\Dto\OrderStatusDto;

interface SendCourierInfoUseCase
{
    public function handle(OrderStatusDto $dto): void;
}
