<?php

declare(strict_types=1);

namespace SmartDelivery\Order\UseCases;

use SmartDelivery\Order\Dto\CreateOrderDto;

interface CreateOrderUseCase
{
    public function handle(CreateOrderDto $dto): void;
}
