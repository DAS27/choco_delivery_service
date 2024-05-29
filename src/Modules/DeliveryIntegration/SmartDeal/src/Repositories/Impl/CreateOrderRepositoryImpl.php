<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryIntegration\SmartDeal\Repositories\Impl;

use Ramsey\Uuid\Uuid;
use SmartDelivery\DeliveryIntegration\SmartDeal\Dto\CreateOrderDto;
use SmartDelivery\DeliveryIntegration\SmartDeal\Entities\OrderEntity;
use SmartDelivery\DeliveryIntegration\SmartDeal\Models\SmartDealModel;
use SmartDelivery\DeliveryIntegration\SmartDeal\Repositories\CreateOrderRepository;

final class CreateOrderRepositoryImpl implements CreateOrderRepository
{
    public function store(CreateOrderDto $dto): OrderEntity
    {
        $model = new SmartDealModel();
        $model->id = Uuid::uuid4()->toString();
        $model->fill($dto->toArray());
        $model->save();

        return $this->buildEntityFromModel($model);
    }

    private function buildEntityFromModel(SmartDealModel $model): OrderEntity
    {
        return OrderEntity::from($model->toArray());
    }
}
