<?php

declare(strict_types=1);

namespace SmartDelivery\Main\Utils\Money;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;
use Money\Parser\DecimalMoneyParser;

final class MoneyParser
{
    public static function fromDecimalString(string $amount, Currency $currency): Money
    {
        $currencies = new ISOCurrencies();
        $moneyParser = new DecimalMoneyParser($currencies);

        return $moneyParser->parse($amount, $currency);
    }
}
