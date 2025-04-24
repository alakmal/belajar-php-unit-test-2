<?php


namespace Alyou\BelajarPhpUnitTest2;

use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{


    /**
     *  @testWith [[5,5],10]
     *            [[4,4,4,4,4],20]
     *            [[3,3,3],9]
     *            [[],0]
     *            [[2],2]
     */
    public function testWith(array $value, int $expected)
    {
        self::assertEquals($expected, Math::sum($value));
    }
}