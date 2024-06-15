<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\UseCases\Impl;

use SmartDelivery\DeliveryService\Raketa\UseCases\ProcessOrderStatusHookUseCase;
use SmartDelivery\HttpClients\SmartDeal\SmartDealHttpClientInterface;
use SmartDelivery\HttpClients\SmartDeal\src\DTO\OrderStatusDto;

final readonly class ProcessOrderStatusHookUseCaseImpl implements ProcessOrderStatusHookUseCase
{
    public function __construct(
        private SmartDealHttpClientInterface $httpClient
    ) {}

    public function handle(OrderStatusDto $dto): void
    {
        $this->httpClient->sendOrderStatus($dto);
    }
}
