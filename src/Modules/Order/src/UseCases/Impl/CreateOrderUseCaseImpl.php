<?php

declare(strict_types=1);

namespace SmartDelivery\Order\UseCases\Impl;

use SmartDelivery\DeliveryService\Main\Dto\CreateExternalOrderDto;
use SmartDelivery\DeliveryService\Main\Dto\WarehouseTypeEnum;
use SmartDelivery\DeliveryService\Main\Enums\DeliveryServiceEnum;
use SmartDelivery\DeliveryService\Main\UseCase\CreateExternalOrderUseCase;
use SmartDelivery\DeliveryService\Raketa\Dto\AddressDto;
use SmartDelivery\DeliveryService\Raketa\Dto\ProductDto;
use SmartDelivery\Order\Dto\RequestOrderDto;
use SmartDelivery\Order\Services\CreateOrderService;
use SmartDelivery\Order\UseCases\CreateOrderUseCase;

final readonly class CreateOrderUseCaseImpl implements CreateOrderUseCase
{
    public function __construct(
        private CreateExternalOrderUseCase $createExternalOrderUseCase,
        private CreateOrderService $orderOrderService
    ) {}

    public function handle(RequestOrderDto $dto): void
    {
        $this->orderOrderService->handle($dto);

        $this->createExternalOrderUseCase->handle(
            new CreateExternalOrderDto(
                external_order_id: $dto->order_id,
                warehouse_order_id: $dto->warehouse_order_id,
                phone: $dto->phone,
                address: AddressDto::from($dto->address),
                serviceEnum: DeliveryServiceEnum::from($dto->delivery_service_name),
                order_created_at: $dto->order_created_at,
                products: array_map(function (array $product) {
                    return new ProductDto(
                        title: $product['title'],
                        price: $product['price'],
                        count: $product['count'],
                        address: AddressDto::from($product['address']),
                        warehouse_type: WarehouseTypeEnum::from($product['warehouse_type'])
                    );
                }, $dto->products),
                total_amount: $dto->total_amount,
                order_planned_at: $dto->order_planned_at,
            )
        );
    }
}
