<?php

declare(strict_types=1);

namespace SmartDelivery\Main\Resources;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;

abstract class AbstractResource implements Arrayable
{
    protected function formatDate(
        Carbon $carbon = null,
        string $format = DATE_RFC3339
    ): ?string {
        return $carbon?->format($format);
    }
}
