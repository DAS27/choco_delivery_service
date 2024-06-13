<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Main\Dto;

enum WarehouseTypeEnum: string
{
    case SD = 'sd';
    case ALL_STYLE = 'all_style';
}
