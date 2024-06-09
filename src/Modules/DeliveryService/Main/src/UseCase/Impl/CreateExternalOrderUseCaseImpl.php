<?php

namespace SmartDelivery\DeliveryService\Main\UseCase\Impl;

use SmartDelivery\DeliveryService\Main\Dto\CreateExternalCardResponse;
use SmartDelivery\DeliveryService\Main\Dto\CreateExternalOrderDto;
use SmartDelivery\DeliveryService\Main\UseCase\CreateExternalOrderUseCase;

final readonly class CreateExternalOrderUseCaseImpl implements CreateExternalOrderUseCase
{
    public function __construct() {}

    public function handle(CreateExternalOrderDto $dto): CreateExternalCardResponse
    {

    }
}
