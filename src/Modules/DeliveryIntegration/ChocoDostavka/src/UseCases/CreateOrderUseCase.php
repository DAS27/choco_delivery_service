<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryIntegration\ChocoDostavka\UseCases;


use SmartDelivery\DeliveryIntegration\SmartDeal\Dto\CreateOrderDto;

interface CreateOrderUseCase
{
    public function handle(CreateOrderDto $dto): void;
}
