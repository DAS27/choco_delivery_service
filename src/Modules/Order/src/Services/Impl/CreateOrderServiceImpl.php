<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Services\Impl;

use Illuminate\Support\Arr;
use SmartDelivery\DeliveryService\Raketa\Dto\AddressDto;
use SmartDelivery\Order\Dto\OrderItemDto;
use SmartDelivery\Order\Dto\RequestOrderDto;
use SmartDelivery\Order\Repositories\OrderItemRepository;
use SmartDelivery\Order\Repositories\OrderRepository;
use SmartDelivery\Order\Services\CreateOrderService;

final readonly class CreateOrderServiceImpl implements CreateOrderService
{
    public function __construct(
        private OrderRepository $orderRepository,
        private OrderItemRepository $orderItemRepository
    ) {}

    public function handle(RequestOrderDto $dto): void
    {
        $orderEntity = $this->orderRepository->store($dto);

        foreach ($dto->products as $product) {
            $this->orderItemRepository->store(new OrderItemDto(
                order_id: $orderEntity->id,
                warehouse_order_id: $dto->warehouse_order_id,
                address: new AddressDto(
                    street: Arr::get($product['address'], 'street'),
                    building: Arr::get($product['address'], 'building'),
                    extra_info: Arr::get($product['address'], 'comment', '-')),
                title: $product['title'],
                quantity: $product['count'],
                price: $product['price'],
            ));
        }
    }
}
