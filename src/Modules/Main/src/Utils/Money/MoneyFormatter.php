<?php

declare(strict_types=1);

namespace SmartDelivery\Main\Utils\Money;

use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;
use Symfony\Polyfill\Intl\Icu\Currencies;

final class MoneyFormatter
{
    public static function toDecimalString(Money $money): string
    {
        $currencies = new ISOCurrencies();
        $moneyFormatter = new DecimalMoneyFormatter($currencies);

        return $moneyFormatter->format($money);
    }

    public static function toDecimalStringWithCurrency(Money $money): string
    {
        $currencies = new ISOCurrencies();
        $moneyFormatter = new DecimalMoneyFormatter($currencies);

        return $moneyFormatter->format($money) . Currencies::getSymbol($money->getCurrency()->getCode());
    }

    public static function getCurrencySymbol(Money $money): string
    {
        return Currencies::getSymbol($money->getCurrency()->getCode());
    }
}
