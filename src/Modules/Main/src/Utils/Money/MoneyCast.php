<?php

declare(strict_types=1);

namespace SmartDelivery\Main\Utils\Money;

use Money\Currency;
use Money\Money;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;

final class MoneyCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $context): mixed
    {
        return match (gettype($value)) {
            'array' => new Money($value['amount'], new Currency($value['currency'])),
            'integer' => new Money($context['value'], new Currency($context['currency'])),
            default => $value
        };
    }
}
