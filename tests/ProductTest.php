<?php


namespace Alyou\BelajarPhpUnitTest2;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Stub\Stub;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{

    private  MockObject & ProductRepository $repository;
    private ProductService $service;

    public function setUp(): void
    {
        $this->repository = $this->createMock(ProductRepository::class);
        $this->service = new ProductService($this->repository);
    }

    public function testMock()
    {
        $product = new Product();
        $product->setId("1");

        $this->repository->expects($this->once())
            ->method("findById")
            ->with($this->equalTo("1"))
            ->willReturn($product);

        /**
         * atas funtion minimal dipanggil 1 kali
         * di method findById argumentnya adalah 1
         * dan mengembalikan $product
         */

        $result = $this->repository->findById("1");
        self::assertSame($product, $result);
    }

    public function testDelete()
    {
        $this->repository->expects($this->once())
            ->method("delete");

        $product = new Product();
        $product->setId("1");

        $this->repository->expects($this->once())
            ->method("findById")
            ->willReturn($product);

        $this->service->delete("1");
        $this->assertTrue(true, "success delete");
    }

    public function testDeleteFailed()
    {
        $this->repository->expects($this->never())
            ->method("delete");
        $this->repository->expects($this->once())
            ->method("findById")
            ->willReturn(null);
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Product is not found");

        $this->service->delete("1");
    }
}