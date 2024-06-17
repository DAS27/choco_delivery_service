<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\UseCases\Impl;

use SmartDelivery\DeliveryService\Main\Enums\DeliveryServiceEnum;
use SmartDelivery\DeliveryService\Raketa\UseCases\SendCourierInfoUseCase;
use SmartDelivery\HttpClients\SmartDeal\Dto\CourierInfoDto;
use SmartDelivery\HttpClients\SmartDeal\Dto\OrderStatusDto;
use SmartDelivery\HttpClients\SmartDeal\SmartDealHttpClientInterface;

final readonly class SendCourierInfoUseCaseImpl implements SendCourierInfoUseCase
{
    public function __construct(
        private SmartDealHttpClientInterface $httpClient,
    ) {}

    public function handle(OrderStatusDto $dto): void
    {
        $this->httpClient->sendCourierInfo(
            new CourierInfoDto(
                order_id: $dto->order_id,
                external_order_id: $dto->external_order_id,
                status: $dto->status,
                delivery_service_name: DeliveryServiceEnum::RAKETA,
                courier_name: $dto->courier_name,
                courier_phone: $dto->courier_phone
            )
        );
    }
}
