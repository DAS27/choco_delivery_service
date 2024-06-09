<?php

namespace SmartDelivery\DeliveryService\Main\UseCase;

use SmartDelivery\DeliveryService\Main\Dto\CreateExternalOrderDto;
use SmartDelivery\DeliveryService\Main\Dto\CreateExternalCardResponse;
use SmartDelivery\DeliveryService\Main\Exceptions\CantCreateExternalOrderException;

interface CreateExternalOrderUseCase
{
    /** @throws CantCreateExternalOrderException */
    public function handle(CreateExternalOrderDto $dto): CreateExternalCardResponse;
}
