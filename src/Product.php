<?php



namespace Alyou\BelajarPhpUnitTest2;

class Product
{
    private string $id, $name, $description;
    private int $price, $quantity;


    public function getId()
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        $this->id = $id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}