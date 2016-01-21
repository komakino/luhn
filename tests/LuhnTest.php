<?php

namespace Komakino\Luhn\Tests;

use ReflectionClass;
use Komakino\Luhn\Luhn;

class LuhnTest extends \PHPUnit_Framework_TestCase
{
    protected $withCheckDigit    = '1234-5678-9012-3452';

    protected $withoutCheckDigit = '555-666-777-88';
    protected $theCheckDigit     = 6;

    public function testValidate()
    {
        $this->assertTrue(Luhn::validate($this->withCheckDigit));
    }

    public function testCalculate()
    {
        $this->assertSame($this->theCheckDigit, Luhn::calculate($this->withoutCheckDigit));
    }

    public function testAppendCheckDigit()
    {
        $appended = Luhn::appendCheckDigit($this->withoutCheckDigit);
        $this->assertSame($this->withoutCheckDigit.$this->theCheckDigit, $appended);
        $this->assertTrue(Luhn::validate($appended));
    }
}
