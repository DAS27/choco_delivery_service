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
    case PICKED_UP = 'picked_up';
    case ARRIVED_TO_CLIENT = 'arrived_to_client';
    case AWAITED_IN_RESTAURANT = 'awaited_in_restaurant';
    case SHOULD_BE_REASSIGNED = 'should_be_reassigned';
}
