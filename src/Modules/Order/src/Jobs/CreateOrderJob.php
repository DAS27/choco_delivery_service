<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Psr\Log\LoggerInterface;
use SmartDelivery\Core\JobDispatcher\BaseJob;
use SmartDelivery\DeliveryService\Raketa\UseCases\CreateOrderUseCase;
use SmartDelivery\Order\Dto\RequestOrderDto;
use SmartDelivery\Order\Exceptions\CantProcessCreateException;

final class CreateOrderJob extends BaseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    public function __construct(
        private readonly RequestOrderDto $requestOrderDto
    ) {
        $this->queue = 'smart-delivery';
    }

    public function handle(
        CreateOrderUseCase $createOrderUseCase,
        LoggerInterface $logger
    ): void {
        try {
            $logger->info('[RaketaCreateOrderJob] Starting process create order');

            $createOrderUseCase->handle($this->requestOrderDto);
        } catch (CantProcessCreateException $e) {
            $logger->critical('[RaketaCreateOrderJob] Cant process create order', [
                'message' => $e->getMessage(),
            ]);

            throw $e;
        }

        $logger->info('[RaketaCreateOrderJob] Success process create order processed');
    }
}
