<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Enums;

enum OrderGroupStatusEnum: string
{
    case NEW = 'new';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case CANCELED = 'canceled';
}
