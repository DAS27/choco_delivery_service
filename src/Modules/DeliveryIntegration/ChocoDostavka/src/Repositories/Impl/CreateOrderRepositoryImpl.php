<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryIntegration\ChocoDostavka\Repositories\Impl;

use Ramsey\Uuid\Uuid;
use SmartDelivery\DeliveryIntegration\ChocoDostavka\Models\ChocoDostavkaModel;
use SmartDelivery\DeliveryIntegration\ChocoDostavka\Repositories\CreateOrderRepository;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\CreateOrderDto;
use SmartDelivery\DeliveryIntegration\ChocoDostavka\Entities\OrderEntity;

final class CreateOrderRepositoryImpl implements CreateOrderRepository
{
    public function store(CreateOrderDto $dto): OrderEntity
    {
        $model = new ChocoDostavkaModel();
        $model->id = Uuid::uuid4()->toString();
        $model->fill($dto->toArray());
        $model->save();

        return $this->buildEntityFromModel($model);
    }

    private function buildEntityFromModel(ChocoDostavkaModel $model): OrderEntity
    {
        return OrderEntity::from($model->toArray());
    }
}
