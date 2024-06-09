<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Repositories\Impl;

use Ramsey\Uuid\Uuid;
use SmartDelivery\DeliveryService\Raketa\Dto\AddressDto;
use SmartDelivery\DeliveryService\Raketa\Dto\ProductDto;
use SmartDelivery\Order\Dto\CreateOrderDto;
use SmartDelivery\Order\Entities\OrderEntity;
use SmartDelivery\Order\Models\OrderModel;
use SmartDelivery\Order\Repositories\CreateOrderRepository;

final class CreateOrderRepositoryImpl implements CreateOrderRepository
{
    public function store(CreateOrderDto $dto): OrderEntity
    {
        $model = new OrderModel();
        $model->id = Uuid::uuid4()->toString();
        $model->phone = $dto->phone;
        $model->scheduled_delivery_time = $dto->planned_datetime;
        $model->external_order_id = $dto->external_order_id;
        $model->save();

        return $this->buildEntityFromModel($model);
    }

    private function buildEntityFromModel(OrderModel $model): OrderEntity
    {
        return new OrderEntity(
            phone: $model->phone,
            point_a: AddressDto::from($model->point_a),
            point_b: AddressDto::from($model->point_b),
            products: array_map(fn($item) => ProductDto::from($item), (array) $model->products),
            external_order_id: (int)$model->external_order_id,
            planned_datetime: $model->planned_datetime,
        );
    }
}
