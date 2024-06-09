<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\UseCases\Impl;

use SmartDelivery\DeliveryService\Raketa\Service\CreateOrderService;
use SmartDelivery\DeliveryService\Raketa\UseCases\CreateOrderUseCase;
use SmartDelivery\HttpClients\Raketa\RaketaHttpClientInterface;
use SmartDelivery\DeliveryService\Raketa\Dto\AddressDto;
use SmartDelivery\DeliveryService\Raketa\Dto\CreateOrderDto as RaketaCreateOrderDto;
use SmartDelivery\DeliveryService\Raketa\Dto\PointDto;
use SmartDelivery\DeliveryService\Raketa\Dto\TaskDto;
use SmartDelivery\HttpClients\Raketa\Enums\TransportTypeEnum;
use SmartDelivery\Main\Exceptions\CantStoreException;

final readonly class CreateOrderUseCaseImpl implements CreateOrderUseCase
{
    public function __construct(
        private CreateOrderService $orderOrderService,
//        private RaketaHttpClientInterface $raketaHttpClient
    ) {}

    public function handle(
        RaketaCreateOrderDto $dto,
    ): void
    {
        $OrderOrderEntity = $this->orderOrderService->handle($dto);


        if ($OrderOrderEntity === null) {
            throw new CantStoreException('Failed to create smart deal order');
        }

        $raketaDto = new RaketaCreateOrderDto(
                transportType: TransportTypeEnum::CAR,
                pointA: new PointDto(
                    phone_number: $OrderOrderEntity->phone,
                    address: new AddressDto(
                            street: $OrderOrderEntity->point_a->street,
                            building: $OrderOrderEntity->point_a->building,
                        ),
                    products: $OrderOrderEntity->products
                ),
                pointB: new PointDto(
                phone_number: $OrderOrderEntity->phone,
                    address: new AddressDto(
                        street: $OrderOrderEntity->point_b->street,
                        building: $OrderOrderEntity->point_b->building,
                    ),
                    products: $OrderOrderEntity->products,
                    merchant_order_id: $OrderOrderEntity->external_order_id,
                    task: new TaskDto(
                        task_id: 11398, // Default task id - check product
                        comment: "Проверить товар"
                    ),
                ),
                callbackUrl: route('raketa.hook.orders.status')
        );

        $this->raketaHttpClient->createOrder($raketaDto);
    }
}
