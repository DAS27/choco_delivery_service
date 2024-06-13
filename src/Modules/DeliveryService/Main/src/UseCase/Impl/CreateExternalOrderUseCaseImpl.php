<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Main\UseCase\Impl;

use Psr\Log\LoggerInterface;
use SmartDelivery\DeliveryService\Main\Contracts\Exceptions\CreateExternalOrderException;
use SmartDelivery\DeliveryService\Main\Dto\CreateExternalOrderDto;
use SmartDelivery\DeliveryService\Main\Factories\DeliveryServiceProviderFactory;
use SmartDelivery\DeliveryService\Main\UseCase\CreateExternalOrderUseCase;

final readonly class CreateExternalOrderUseCaseImpl implements CreateExternalOrderUseCase
{
    public function __construct(
        private DeliveryServiceProviderFactory $deliveryServiceProviderFactory,
        private LoggerInterface $logger
    ) {}

    public function handle(CreateExternalOrderDto $dto): void
    {
        try {
            $createContract = $this->deliveryServiceProviderFactory->buildIssueContract($dto->serviceEnum);

            $createContract->handle($dto);
        } catch (CreateExternalOrderException $e) {
            $this->logger->critical('Не получается создать заказ по API', [
                'message' => $e->getMessage(),
                'orderId' => $dto->external_order_id,
                'service' => $dto->serviceEnum
            ]);
        }
    }
}
