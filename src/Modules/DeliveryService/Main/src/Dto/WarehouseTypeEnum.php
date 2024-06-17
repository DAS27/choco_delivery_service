<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Main\Dto;

enum WarehouseTypeEnum: string
{
    case OWN = 'own';
    case EXTERNAL = 'external';
}
