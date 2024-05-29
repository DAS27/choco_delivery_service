<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\ChocoDostavka\Enums;

enum OrderGroupStatusEnum: string
{
    case CREATED = 'CREATED';
    case PLANNED = 'PLANNED';
    case LOOKING_FOR_COURIER = 'LOOKING_FOR_COURIER';
    case IN_THE_WAY = 'IN_THE_WAY';
    case CANCELED = 'CANCELED';
    case COMPLETED = 'COMPLETED';
}
