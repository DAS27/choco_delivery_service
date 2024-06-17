<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\UseCases\Impl;

use SmartDelivery\DeliveryService\Main\Enums\DeliveryServiceEnum;
use SmartDelivery\DeliveryService\Raketa\Service\FindGroupOrderByOrderIdService;
use SmartDelivery\DeliveryService\Raketa\UseCases\ProcessOrderStatusHookUseCase;
use SmartDelivery\HttpClients\SmartDeal\Dto\OrderStatusDto;
use SmartDelivery\HttpClients\SmartDeal\SmartDealHttpClientInterface;

final readonly class ProcessOrderStatusHookUseCaseImpl implements ProcessOrderStatusHookUseCase
{
    public function __construct(
        private SmartDealHttpClientInterface $httpClient,
        private FindGroupOrderByOrderIdService $findGroupOrderById
    ) {}

    public function handle(OrderStatusDto $dto): void
    {
        $orderGroupEntity = $this->findGroupOrderById->handle($dto->order_id);

        if ($orderGroupEntity === null) {
            return;
        }

        $this->httpClient->sendOrderStatus(new OrderStatusDto(
            order_id: $dto->order_id,
            external_order_id: $orderGroupEntity->external_order_id,
            warehouse_order_id: $dto->warehouse_order_id,
            delivery_service_name: DeliveryServiceEnum::RAKETA,
            status: $dto->status
        ));
    }
}
