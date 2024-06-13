<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Main\UseCase\Impl;

use SmartDelivery\DeliveryService\Main\Dto\CreateExternalCardResponse;
use SmartDelivery\DeliveryService\Main\Dto\CreateExternalOrderDto;
use SmartDelivery\DeliveryService\Main\Factories\DeliveryServiceProviderFactory;
use SmartDelivery\DeliveryService\Main\UseCase\CreateExternalOrderUseCase;

final readonly class CreateExternalOrderUseCaseImpl implements CreateExternalOrderUseCase
{
    public function __construct(
        private DeliveryServiceProviderFactory $deliveryServiceProviderFactory
    ) {}

    public function handle(CreateExternalOrderDto $dto): CreateExternalCardResponse
    {
        $createContract = $this->deliveryServiceProviderFactory->buildIssueContract($dto->serviceEnum);

    }
}
