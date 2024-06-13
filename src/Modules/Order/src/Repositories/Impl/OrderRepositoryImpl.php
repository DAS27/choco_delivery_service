<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Repositories\Impl;

use Ramsey\Uuid\Uuid;
use SmartDelivery\DeliveryService\Main\Enums\DeliveryServiceEnum;
use SmartDelivery\DeliveryService\Raketa\Dto\AddressDto;
use SmartDelivery\Order\Dto\RequestOrderDto;
use SmartDelivery\Order\Entities\OrderEntity;
use SmartDelivery\Order\Enums\OrderStatusEnum;
use SmartDelivery\Order\Models\OrderModel;
use SmartDelivery\Order\Repositories\OrderRepository;

final class OrderRepositoryImpl implements OrderRepository
{
    public function store(RequestOrderDto $dto): OrderEntity
    {
        $model = new OrderModel();
        $model->id = Uuid::uuid4()->toString();
        $model->merchant_id = $dto->merchant_id;
        $model->external_order_id = $dto->order_id;
        $model->delivery_service_name = $dto->delivery_service_name;
        $model->delivery_address = $dto->address;
        $model->phone = $dto->phone;
        $model->scheduled_delivery_time = $dto->order_planned_at ?: null;
        $model->status = OrderStatusEnum::NEW->value;
        $model->total_amount = $dto->total_amount;
        $model->save();

        return $this->buildEntityFromModel($model);
    }

    private function buildEntityFromModel(OrderModel $model): OrderEntity
    {
        return new OrderEntity(
            id: $model->id,
            merchant_id: $model->merchant_id,
            external_order_id: $model->external_order_id,
            delivery_service_name: $model->delivery_service_name,
            address: AddressDto::from($model->delivery_address),
            phone: $model->phone,
            status: $model->status,
            total_amount: $model->total_amount,
            scheduled_delivery_time: $model->scheduled_delivery_time,
        );
    }
}
