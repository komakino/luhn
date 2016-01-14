<?php

namespace Komakino\Luhn\Tests;

use ReflectionClass;
use Komakino\Luhn\Luhn;

class LuhnTest extends \PHPUnit_Framework_TestCase
{
    protected $withCheckDigit    = '1234-5678-9012-3452';

    protected $withoutCheckDigit = '555-666-777-88';
    protected $theCheckDigit     = 6;


    protected static function getMethod($class,$name) {
        $class = new ReflectionClass($class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

    protected static function runNonPublicMethod($class,$method,$arguments = [])
    {
        $method = self::getMethod($class,$method);
        return $method->invokeArgs(null, $arguments);
    }

    public function testToInt()
    {
        $this->assertSame(1234567890123452,self::runNonPublicMethod(Luhn::class,'toInt',[$this->withCheckDigit]));
    }

    public function testGetChecksum()
    {
        $this->assertSame(0,Luhn::getChecksum($this->withCheckDigit));
    }

    public function testValidate()
    {
        $this->assertTrue(Luhn::validate($this->withCheckDigit));
    }

    public function testCalculate()
    {
        $this->assertSame($this->theCheckDigit, Luhn::calculate($this->withoutCheckDigit));
    }

    public function testAppendChecksum()
    {
        $appended = Luhn::appendChecksum($this->withoutCheckDigit);
        $this->assertSame($this->withoutCheckDigit.$this->theCheckDigit, $appended);
        $this->assertTrue(Luhn::validate($appended));
    }
}