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

    public function testFirst(): Counter
    {
        $counter = new Counter();
        $counter->increment();
        $this->assertEquals(1, $counter->getCounter());
        return $counter;
    }


    /**
     * @depends testFirst
     */
    public function testSecond(Counter $counter)
    {

        $counter->increment();
        $this->assertEquals(2, $counter->getCounter());
    }
}