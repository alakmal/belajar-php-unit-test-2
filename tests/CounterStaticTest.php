<?php

use Alyou\BelajarPhpUnitTest2\Counter;
use PHPUnit\Framework\TestCase;

class CounterStaticTest extends TestCase
{

    static private Counter $counter;


    public static function setUpBeforeClass(): void
    {
        self::$counter = new Counter();
    }

    public function testFirst()
    {
        self::$counter->increment();
        self::assertEquals(1, self::$counter->getCounter());
    }

    public function testSecond()
    {
        self::$counter->increment();
        self::assertEquals(2, self::$counter->getCounter());
    }
}