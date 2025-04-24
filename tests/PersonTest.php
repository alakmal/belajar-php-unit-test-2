<?php


namespace Alyou\BelajarPhpUnitTest2;

use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{

    public function testSucces()
    {

        $person = new Person("Eko");

        self::assertEquals("Hi Budi, my name is Eko", $person->sayHello("Budi"));
    }

    public function testException()
    {
        $person = new Person("Eko");
        $this->expectException(\exception::class);
        $person->sayHello(null);
    }
}