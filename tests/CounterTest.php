<?php


namespace Alyou\BelajarPhpUnitTest2;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class CounterTest extends TestCase
{


    public function testCounter()
    {
        $counter = new Counter();
        $counter->increment();
        Assert::assertEquals(
            1,
            $counter->getCounter()
        );
    }
}