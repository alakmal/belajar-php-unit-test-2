<?php

namespace Alyou\BelajarPhpUnitTest2;

class Person
{

    public function __construct(
        private string $name
    ) {}

    public function sayHello(?string $name)
    {

        if ($name == null) throw new \Exception("Name is null");

        return "Hi $name, my name is {$this->name}";
    }
}