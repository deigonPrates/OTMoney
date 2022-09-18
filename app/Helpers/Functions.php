<?php

use JetBrains\PhpStorm\Pure;

function formatDate($value, $format = 'd/m/Y'): string
{
    return Carbon\Carbon::parse($value)->format($format);
}

/**
 * @param $value
 * @param $currency
 * @return string
 */
#[Pure] function formatCurrency($value, $currency): string{
    $fmt = new NumberFormatter( 'pt_BR', NumberFormatter::CURRENCY );
    return $fmt->formatCurrency($value, $currency);
}
