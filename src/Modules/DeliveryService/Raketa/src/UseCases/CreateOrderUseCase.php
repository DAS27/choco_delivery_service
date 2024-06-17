<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\UseCases;

use SmartDelivery\Order\Dto\RequestOrderDto;
use SmartDelivery\Order\Exceptions\CantProcessCreateException;

interface CreateOrderUseCase
{
    /**
     * @throws CantProcessCreateException
     */
    public function handle(RequestOrderDto $dto): void;
}
