<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Repositories\Impl;

use Ramsey\Uuid\Uuid;
use SmartDelivery\DeliveryService\Raketa\Dto\OrderGroupDto;
use SmartDelivery\DeliveryService\Raketa\Entities\OrderGroupEntity;
use SmartDelivery\DeliveryService\Raketa\Models\RaketaOrderGroupModel;
use SmartDelivery\DeliveryService\Raketa\Repositories\OrderGroupRepository;

final class OrderGroupRepositoryImpl implements OrderGroupRepository
{

    public function store(OrderGroupDto $dto): ?OrderGroupEntity
    {
        $model = new RaketaOrderGroupModel();
        $model->id = Uuid::uuid4()->toString();
        $model->order_id = $dto->order_id;
        $model->external_order_id = $dto->external_order_id;
        $model->status = $dto->status;
        $model->save();

        return $this->buildEntityFromModel($model);
    }

    private function buildEntityFromModel(RaketaOrderGroupModel $model): OrderGroupEntity
    {
        return OrderGroupEntity::from($model->toArray());
    }
}
