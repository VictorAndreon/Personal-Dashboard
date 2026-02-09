<?php

if (!function_exists('format_currency')){

    function format_currency(float $amount, string $currency = 'BRL', ?string $sign = null)
    {
        $config = config("currencies.$currency");

        $formattedNumber = number_format(abs($amount), $config['precision'], $config['decimal'], $config['thousand']);

        if (isset($sign)){
            $prefix = $sign;

        }else{
            $prefix = $amount < 0 ? '-' : '';
        }     

        return trim("{$prefix} {$config['symbol']} {$formattedNumber}");
    }
}