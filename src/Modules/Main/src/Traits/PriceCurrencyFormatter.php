<?php

declare(strict_types=1);

namespace SmartDelivery\Main\Traits;

use Money\Currency;
use Money\Money;

/**
 * @property numeric-string $price
 * @property string $currency
 */
trait PriceCurrencyFormatter
{
    public function getPriceMoneyAttribute(): ?Money
    {
        if (is_null($this->price) || is_null($this->price_currency)) {
            return null;
        }

        return new Money($this->price, new Currency($this->price_currency));
    }
}
