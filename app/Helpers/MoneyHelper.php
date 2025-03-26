<?php

namespace App\Helpers;

class MoneyHelper
{
    public static function fromDollarsToCents(string $dollars): int
    {
        return (int) bcmul($dollars, '100', '0');
    }

    public static function fromCentsToDollars(string|int $cents): string
    {
        return bcdiv((string) $cents, '100', '2');
    }
}