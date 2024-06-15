<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Enums;

enum OrderStatusEnum: string
{
    case NEW = 'new';
    case CANCELED = 'canceled';
}
