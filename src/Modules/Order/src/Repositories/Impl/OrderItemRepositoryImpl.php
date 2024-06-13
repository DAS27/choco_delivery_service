<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Repositories\Impl;

use Ramsey\Uuid\Uuid;
use SmartDelivery\Order\Dto\OrderItemDto;
use SmartDelivery\Order\Models\OrderItemModel;
use SmartDelivery\Order\Repositories\OrderItemRepository;

final class OrderItemRepositoryImpl implements OrderItemRepository
{
    public function store(OrderItemDto $dto): void
    {
        $model = new OrderItemModel();
        $model->id = Uuid::uuid4()->toString();
        $model->order_id = $dto->order_id;
        $model->warehouse_order_id = $dto->warehouse_order_id;
        $model->pickup_address = $dto->address->toArray();
        $model->title = $dto->title;
        $model->quantity = $dto->quantity;
        $model->price = $dto->price;
        $model->comments = $dto->comments;
        $model->save();
    }
}
