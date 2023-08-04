<?php

namespace App\Helpers;

class GeneralHelper
{
    public static function moneyFormat($number, $decimals = 2)
    {
        $number = (float) $number;

        if ($number < 0) {
            $number = "(" . number_format(abs($number), $decimals) . ")";
        } else {
            $number = number_format($number, $decimals);
        }

        return $number;
    }
}
