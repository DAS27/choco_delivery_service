<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\UseCases\Impl;

use SmartDelivery\DeliveryService\Main\Contracts\CancelOrderContract;
use SmartDelivery\DeliveryService\Main\Enums\DeliveryServiceEnum;
use SmartDelivery\HttpClients\Raketa\RaketaHttpClientInterface;
use SmartDelivery\Order\Dto\CancelOrderDto;

final readonly class RaketaCancelOrderContractImpl implements CancelOrderContract
{
    public function __construct(
        private RaketaHttpClientInterface $httpClient,
    ) {}

    /**
     * @inheritDoc
     */
    public function handle(CancelOrderDto $dto): void
    {
        $this->httpClient->cancelOrder($dto->order_id);
    }

    public function getProvider(): DeliveryServiceEnum
    {
        return DeliveryServiceEnum::RAKETA;
    }
}
