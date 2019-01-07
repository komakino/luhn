<?php

namespace Komakino\Luhn\Tests;

use Komakino\Luhn\Luhn;

class LuhnTest extends \PHPUnit_Framework_TestCase
{

    public function provideValues()
    {
        return [
            ['1234-5678-9012-3452', '1234-5678-9012-345', 2],
            ['555-666-777-886', '555-666-777-88', 6],
            ['670919-9530', '670919-953', 0],
            ['0005251236', '000525123', 6]
        ];
    }

    /**
     * @param string $withCheckDigit
     * @dataProvider provideValues
     */
    public function testValidate($withCheckDigit)
    {
        $this->assertTrue(Luhn::validate($withCheckDigit));
    }

    /**
     * @param string $withCheckDigit
     * @param string $withoutCheckDigit
     * @param int $checkDigit
     * @dataProvider provideValues
     */
    public function testCalculate($withCheckDigit, $withoutCheckDigit, $checkDigit)
    {
        $this->assertSame($checkDigit, Luhn::calculate($withoutCheckDigit));
    }

    /**
     * @param string $withCheckDigit
     * @param string $withoutCheckDigit
     * @param int $checkDigit
     * @dataProvider provideValues
     */
    public function testAppendCheckDigit($withCheckDigit, $withoutCheckDigit, $checkDigit)
    {
        $appended = Luhn::appendCheckDigit($withoutCheckDigit);
        $this->assertSame($withoutCheckDigit.$checkDigit, $appended);
        $this->assertTrue(Luhn::validate($appended));
    }
}
