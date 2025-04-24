<?php


namespace Alyou\BelajarPhpUnitTest2;

use PHPUnit\Framework\TestCase;

class CounterTest extends TestCase
{


    public function testCounter()
    {
        $counter = new Counter();
        $counter->increment();
        $this->assertEquals(1, $counter->getCounter());
    }

    public function testIncrement()
    {
        $counter = new Counter();
        self::assertEquals(0, $counter->getCounter());
        self::markTestIncomplete();
    }
}