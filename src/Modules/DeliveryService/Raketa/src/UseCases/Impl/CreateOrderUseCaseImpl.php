<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\UseCases\Impl;

use Illuminate\Database\DatabaseManager;
use Psr\Log\LoggerInterface;
use SmartDelivery\DeliveryService\Raketa\UseCases\CreateOrderUseCase;
use SmartDelivery\Order\Dto\RequestOrderDto;
use SmartDelivery\Order\Strategies\CreateOrderProcess\Exception\CantOrderProcessStrategy;
use SmartDelivery\Order\Strategies\CreateOrderProcess\Impl\CreateOrderProcessStrategy;
use SmartDelivery\Order\Strategies\CreateOrderProcess\Impl\PlannedOrderProcessStrategy;
use SmartDelivery\Order\Strategies\CreateOrderProcess\OrderProcessStrategy;
use Throwable;

final readonly class CreateOrderUseCaseImpl implements CreateOrderUseCase
{
    public function __construct(
        private DatabaseManager $databaseManager,
        private LoggerInterface $logger
    ) {}

    public function handle(RequestOrderDto $dto): void
    {
        $this->databaseManager->beginTransaction();

        $strategy = null;
        if ($dto->order_planned_at === null) {
            $strategy = app()->make(CreateOrderProcessStrategy::class);
        } else {
            $strategy = app()->make(PlannedOrderProcessStrategy::class);
        }

        try {
            /** @var OrderProcessStrategy $strategy */
            $strategy->handle($dto);
        } catch (Throwable $e) {
            $this->logger->critical('[CardHoldBalanceProcessUseCase]', [
                'exception' => $e->getMessage(),
                'orderId' => $dto->order_id,
            ]);

            $this->databaseManager->rollBack();

            throw new CantOrderProcessStrategy($e->getMessage(), (int) $e->getCode(), $e);
        }

        $this->databaseManager->commit();
    }
}
