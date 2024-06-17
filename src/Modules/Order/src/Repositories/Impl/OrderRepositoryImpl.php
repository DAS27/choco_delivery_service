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
        $model->merchant_name = $dto->merchant_name;
        $model->external_order_id = $dto->order_id;
        $model->delivery_service_name = $dto->delivery_service_name;
        $model->delivery_address = $dto->delivery_address;
        $model->recipient_phone = $dto->recipient_phone;
        $model->sender_phone = $dto->sender_phone;
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
            merchant_name: $model->merchant_name,
            external_order_id: $model->external_order_id,
            delivery_service_name: DeliveryServiceEnum::from($model->delivery_service_name->value),
            delivery_address: AddressDto::from($model->delivery_address),
            recipient_phone: $model->recipient_phone,
            sender_phone: $model->sender_phone,
            status: OrderStatusEnum::from($model->status->value),
            total_amount: $model->total_amount,
            scheduled_delivery_time: $model->scheduled_delivery_time,
        );
    }
}
