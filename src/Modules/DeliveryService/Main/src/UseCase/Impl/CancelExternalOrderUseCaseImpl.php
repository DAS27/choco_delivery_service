<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Main\UseCase\Impl;

use Psr\Log\LoggerInterface;
use SmartDelivery\DeliveryService\Main\Exceptions\CantCancelOrderException;
use SmartDelivery\DeliveryService\Main\Exceptions\UnknownDeliveryServiceTypeException;
use SmartDelivery\DeliveryService\Main\Factories\DeliveryServiceProviderFactory;
use SmartDelivery\DeliveryService\Main\UseCase\CancelExternalOrderUseCase;
use SmartDelivery\Order\Dto\CancelOrderDto;

final readonly class CancelExternalOrderUseCaseImpl implements CancelExternalOrderUseCase
{
    public function __construct(
        private DeliveryServiceProviderFactory $deliveryServiceProviderFactory,
        private LoggerInterface $logger
    ) {}

    public function handle(CancelOrderDto $dto): void
    {
        try {
            $createContract = $this->deliveryServiceProviderFactory->buildCancelContract($dto->service_name);

            $createContract->handle($dto);
        } catch (CantCancelOrderException|UnknownDeliveryServiceTypeException $e) {
            $this->logger->critical('Не получается отменить заказ по API', [
                'message' => $e->getMessage(),
                'orderId' => $dto->order_id,
                'service' => $dto->service_name->value
            ]);

            throw $e;
        }
    }
}
