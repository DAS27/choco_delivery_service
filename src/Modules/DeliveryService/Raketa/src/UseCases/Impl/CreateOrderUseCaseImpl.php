<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\UseCases\Impl;

use Carbon\Carbon;
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
    ) {
    }

    public function handle(RequestOrderDto $dto): void
    {
        $this->databaseManager->beginTransaction();

        try {
            $orderCreatedAt = Carbon::parse($dto->order_created_at);
            $closedTime = $orderCreatedAt->copy()->setTime(16, 59, 0);

            if ($dto->order_planned_at !== null) {
                $strategy = app()->make(PlannedOrderProcessStrategy::class);
            } else {
                if ($orderCreatedAt->greaterThanOrEqualTo($closedTime)) {
                    $dto->order_planned_at = $this->getNextBusinessDay($orderCreatedAt)->toDateTimeString();
                    $strategy = app()->make(PlannedOrderProcessStrategy::class);
                } else {
                    $strategy = app()->make(CreateOrderProcessStrategy::class);
                }
            }

            /** @var OrderProcessStrategy $strategy */
            $strategy->handle($dto);
            $this->databaseManager->commit();
        } catch (Throwable $e) {
            $this->logger->critical('[CreateOrderUseCase]', [
                'exception' => $e->getMessage(),
                'orderId' => $dto->order_id,
            ]);

            $this->databaseManager->rollBack();

            throw new CantOrderProcessStrategy($e->getMessage(), (int)$e->getCode(), $e);
        }
    }

    private function getNextBusinessDay(Carbon $date): Carbon
    {
        $nextBusinessDay = $date->copy()->addDay();
        while ($nextBusinessDay->isWeekend()) {
            $nextBusinessDay->addDay();
        }
        return $nextBusinessDay->setTime(11, 0, 0);
    }
}
