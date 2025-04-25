<?php


namespace Alyou\BelajarPhpUnitTest2;

interface   ProductRepository
{

    function save(Product $product): Product;

    function delete(Product $product): void;

    function findById(string $id): ?Product;

    function findAll(): array;
}



class ProductService
{

    public function __construct(private ProductRepository $repository) {}

    public function register(Product $product): Product
    {
        if ($this->repository->findById($product->getId() !== null)) {
            throw new \Exception("Product is Already exists");
        }
        return $this->repository->save($product);
    }

    public function delete(string $id): void
    {
        $product = $this->repository->findById($id);
        if ($product == null) {
            throw new \Exception("Product is not found");
        }
        $this->repository->delete($product);
    }
}