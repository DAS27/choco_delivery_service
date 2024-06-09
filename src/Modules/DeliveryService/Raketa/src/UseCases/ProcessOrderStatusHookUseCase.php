<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\UseCases;

use SmartDelivery\DeliveryService\Raketa\Dto\ProcessOrderStatusHookDto;

interface ProcessOrderStatusHookUseCase
{
    public function handle(ProcessOrderStatusHookDto $dto): void;
}
