<?php

namespace Komakino\Luhn;

class Luhn
{
    protected static function toInt($number) {
        return preg_replace('/[^\d]/','',$number);
    }

    protected static function getChecksum($number)
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

    public static function calculate($partial_number)
    {
        $partial_number = static::toInt($partial_number);
        $checksum       = static::getChecksum($partial_number);
        return $checksum ? 10 - $checksum : $checksum;
    }

    public static function appendCheckDigit($partial_number){
        return $partial_number . static::calculate($partial_number);
    }
}
