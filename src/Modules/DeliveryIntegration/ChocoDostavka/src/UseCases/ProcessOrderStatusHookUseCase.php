<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryIntegration\ChocoDostavka\UseCases;

use SmartDelivery\DeliveryIntegration\ChocoDostavka\Dto\ProcessOrderStatusHookDto;

interface ProcessOrderStatusHookUseCase
{
    public function handle(ProcessOrderStatusHookDto $dto): void;
}
