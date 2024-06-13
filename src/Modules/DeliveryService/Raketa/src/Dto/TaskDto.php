<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Dto;

use Spatie\LaravelData\Data;

final class TaskDto extends Data
{
    public function __construct(
        public ?int $task_id,
        public ?string $comment = null
    ) {}
}
