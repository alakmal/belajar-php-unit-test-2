<?php


namespace Alyou\BelajarPhpUnitTest2;

use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{

    private Person $person;

    /**
     * @before
     */
    protected function createPerson(): void
    {
        $this->person = new Person("Eko");
    }


    protected function tearDown(): void
    {
        echo "tear down" . PHP_EOL;
    }

    /**
     * @after
     */
    protected function after()
    {
        echo "after" . PHP_EOL;
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