<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Repositories\Impl;

use Ramsey\Uuid\Uuid;
use SmartDelivery\DeliveryService\Raketa\Models\RaketaModel;
use SmartDelivery\DeliveryService\Raketa\Repositories\CreateOrderRepository;
use SmartDelivery\DeliveryService\Raketa\Dto\CreateOrderDto;
use SmartDelivery\DeliveryService\Raketa\Entities\OrderEntity;

final class CreateOrderRepositoryImpl implements CreateOrderRepository
{
    public function store(CreateOrderDto $dto): OrderEntity
    {
        $model = new RaketaModel();
        $model->id = Uuid::uuid4()->toString();
        $model->fill($dto->toArray());
        $model->save();

        return $this->buildEntityFromModel($model);
    }

    private function buildEntityFromModel(RaketaModel $model): OrderEntity
    {
        return OrderEntity::from($model->toArray());
    }
}
