<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\UseCases\Impl;

use SmartDelivery\DeliveryService\Main\Contracts\CreateOrderContract;
use SmartDelivery\DeliveryService\Main\Dto\CreateExternalOrderDto;
use SmartDelivery\DeliveryService\Main\Dto\WarehouseTypeEnum;
use SmartDelivery\DeliveryService\Main\Enums\DeliveryServiceEnum;
use SmartDelivery\DeliveryService\Raketa\Dto\ContactInfoDto;
use SmartDelivery\DeliveryService\Raketa\Dto\CreateOrderDto;
use SmartDelivery\DeliveryService\Raketa\Dto\PointDto;
use SmartDelivery\DeliveryService\Raketa\Dto\ProductDto;
use SmartDelivery\DeliveryService\Raketa\Dto\TaskDto;
use SmartDelivery\HttpClients\Raketa\Enums\TransportTypeEnum;
use SmartDelivery\HttpClients\Raketa\RaketaHttpClientInterface;

final readonly class RaketaOrderContractImpl implements CreateOrderContract
{
    public function __construct(
        private RaketaHttpClientInterface $httpClient,
    ) {}

    public function handle(CreateExternalOrderDto $externalOrderDto): void
    {
        $finalPoint = new PointDto(
            contact_info: new ContactInfoDto(phone_number: $externalOrderDto->phone),
            address: $externalOrderDto->address,
        );

        $startPoint = array_map(function (ProductDto $productDto) use ($externalOrderDto) {
            return new PointDto(
                contact_info: new ContactInfoDto(phone_number: $externalOrderDto->phone),
                address: $productDto->address,
                items: [new ProductDto(
                    title: $productDto->title,
                    price: $productDto->price,
                    count: $productDto->count,
                    address: null,
                    warehouse_type: null
                )],
                merchant_order_id: $externalOrderDto->warehouse_order_id,
                tasks: [new TaskDto(
                    id: $productDto->warehouse_type === WarehouseTypeEnum::ALL_STYLE ? 11398 : null,
                )]
            );
        }, $externalOrderDto->products);

        $response = $this->httpClient->createOrder(
            new CreateOrderDto(
                transportType: TransportTypeEnum::CAR,
                points: array_map(
                    (fn(PointDto $point) => $point->toArray()),
                    array_merge($startPoint, [$finalPoint])
                ),
                callbackUrl: "https://67c4-46-235-72-49.ngrok-free.app",
                orderPlannedAt: $externalOrderDto->order_planned_at
            )
        );
    }

    public function getProvider(): DeliveryServiceEnum
    {
        return DeliveryServiceEnum::RAKETA;
    }
}
