<?php

namespace Komakino\Luhn;

class Luhn
{
    protected static function toInt($number) {
        return (int)preg_replace('/\W/','',$number);
    }

    public static function getChecksum($number)
    {
        $number   = static::toInt($number);
        $sequence = str_split($number);
        $sum      = 0;
        for($i=0; $i<count($sequence); $i++){
            $factor = $i % 2 ? 1 : 2;
            $sum += array_sum(str_split($sequence[$i] * $factor));
        }

        return $sum % 10;
    }

    public static function validate($number)
    {
        return static::getChecksum($number) === 0;
    }

    public static function calculate($number)
    {
        $number   = static::toInt($number);
        $checksum = static::getChecksum($number * 10);
        return $checksum ? 10 - $checksum : $checksum;
    }

    public static function appendChecksum($number){
        return $number . static::calculate($number);
    }
}
