<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\UseCases\Impl;

use Illuminate\Support\Facades\Log;
use SmartDelivery\DeliveryService\Main\Contracts\CreateOrderContract;
use SmartDelivery\DeliveryService\Main\Contracts\Dto\CreateOrderResponseDto;
use SmartDelivery\DeliveryService\Main\Dto\CreateExternalOrderDto;
use SmartDelivery\DeliveryService\Main\Dto\WarehouseTypeEnum;
use SmartDelivery\DeliveryService\Main\Enums\DeliveryServiceEnum;
use SmartDelivery\DeliveryService\Main\Exceptions\CantCreateExternalOrderException;
use SmartDelivery\DeliveryService\Raketa\Dto\CreateOrderDto;
use SmartDelivery\DeliveryService\Raketa\Dto\PointDto;
use SmartDelivery\DeliveryService\Raketa\Dto\ProductDto;
use SmartDelivery\DeliveryService\Raketa\Dto\TaskDto;
use SmartDelivery\HttpClients\Raketa\Entities\UnexpectedErrorException;
use SmartDelivery\HttpClients\Raketa\Enums\TransportTypeEnum;
use SmartDelivery\HttpClients\Raketa\RaketaHttpClientInterface;

final readonly class RaketaOrderContractImpl implements CreateOrderContract
{
    public function __construct(
        private RaketaHttpClientInterface $httpClient,
    ) {}
    public function handle(CreateExternalOrderDto $externalOrderDto): void
    {
        Log::info('Entering handle method in RaketaOrderContractImpl');

        $finalPoint = new PointDto(
            phone_number: $externalOrderDto->phone,
            address: $externalOrderDto->address,
            products: null,
            merchant_order_id: null,
            task: null
        );

        $points = array_map(function (ProductDto $productDto) use ($externalOrderDto) {
            return new PointDto(
                phone_number: $externalOrderDto->phone,
                address: $productDto->address,
                products: [new ProductDto(
                    title: $productDto->title,
                    price: $productDto->price,
                    count: $productDto->count,
                    address: null,
                    warehouse_type: null
                )],
                merchant_order_id: $externalOrderDto->warehouse_order_id,
                task: new TaskDto(
                    task_id: $productDto->warehouse_type === WarehouseTypeEnum::ALL_STYLE ? 11398 : null,
                    comment: null
                )
            );
        }, $externalOrderDto->products);

        $response = $this->httpClient->createOrder(
            new CreateOrderDto(
            transportType: TransportTypeEnum::CAR,
            points: array_merge($points, [$finalPoint])
        ));
    }

    public function getProvider(): DeliveryServiceEnum
    {
        return DeliveryServiceEnum::RAKETA;
    }
}
