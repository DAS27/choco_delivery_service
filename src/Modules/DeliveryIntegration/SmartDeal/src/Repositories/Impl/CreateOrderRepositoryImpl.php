<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryIntegration\SmartDeal\Repositories\Impl;

use Ramsey\Uuid\Uuid;
use SmartDelivery\DeliveryIntegration\SmartDeal\Dto\CreateOrderDto;
use SmartDelivery\DeliveryIntegration\SmartDeal\Entities\OrderEntity;
use SmartDelivery\DeliveryIntegration\SmartDeal\Models\SmartDealModel;
use SmartDelivery\DeliveryIntegration\SmartDeal\Repositories\CreateOrderRepository;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\AddressDto;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\ProductDto;

final class CreateOrderRepositoryImpl implements CreateOrderRepository
{
    public function store(CreateOrderDto $dto): OrderEntity
    {
        $model = new SmartDealModel();
        $model->id = Uuid::uuid4()->toString();
        $model->phone = $dto->phone;
        $model->point_a = $dto->point_a->toArray();
        $model->point_b = $dto->point_b->toArray();
        $model->products = array_map(fn($item) => $item->toArray(), $dto->products);
        $model->planned_datetime = $dto->planned_datetime;
        $model->external_order_id = $dto->external_order_id;
        $model->save();

        return $this->buildEntityFromModel($model);
    }

    private function buildEntityFromModel(SmartDealModel $model): OrderEntity
    {
        return new OrderEntity(
            phone: $model->phone,
            point_a: AddressDto::from($model->point_a),
            point_b: AddressDto::from($model->point_b),
            products: array_map(fn($item) => ProductDto::from($item), $model->products),
            external_order_id: $model->external_order_id,
            planned_datetime: $model->planned_datetime,
        );
    }
}
