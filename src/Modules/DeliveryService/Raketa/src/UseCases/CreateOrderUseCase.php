<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\UseCases;


use SmartDelivery\DeliveryService\Raketa\Dto\CreateOrderDto;

interface CreateOrderUseCase
{
    public function handle(CreateOrderDto $dto): void;
}
