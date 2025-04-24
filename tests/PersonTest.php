<?php


namespace Alyou\BelajarPhpUnitTest2;

use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{

    private Person $person;

    protected function setUp(): void
    {
        $this->person = new Person("Eko");
    }
    public function testSucces()
    {


        self::assertEquals("Hi Budi, my name is Eko", $this->person->sayHello("Budi"));
    }

    public function testException()
    {
        $this->expectException(\exception::class);
        $this->person->sayHello(null);
    }
}