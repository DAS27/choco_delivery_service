<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Enums;

enum OrderStatusEnum: string
{
    case ASSIGNED = 'assigned';
    case ACCEPTED = 'accepted';
    case DELIVERED = 'delivered';
    case CANCELED = 'cancelled';
    case CREATED = 'created';
}
