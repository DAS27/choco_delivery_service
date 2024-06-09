<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\UseCases\Impl;

use SmartDelivery\DeliveryService\Main\Contracts\CreateOrderContract;
use SmartDelivery\DeliveryService\Main\Contracts\Dto\CreateOrderRequestDto;
use SmartDelivery\DeliveryService\Main\Contracts\Dto\CreateOrderResponseDto;
use SmartDelivery\DeliveryService\Raketa\Service\CreateOrderService;
use SmartDelivery\HttpClients\Raketa\RaketaHttpClientInterface;
use SmartDelivery\Order\Enums\OrderProviderEnum;


final readonly class RaketaOrderContractImpl implements CreateOrderContract
{
    public function __construct(
//        private RaketaHttpClientInterface $httpClient,
//        private CreateOrderService $OrderOrderService,
    ) {}
    public function handle(CreateOrderRequestDto $request): CreateOrderResponseDto
    {
        // TODO: Implement handle() method.
    }

    public function getProvider(): OrderProviderEnum
    {
        return OrderProviderEnum::RAKETA;
    }
}
