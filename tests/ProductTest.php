<?php


namespace Alyou\BelajarPhpUnitTest2;

use PHPUnit\Framework\MockObject\Stub\Stub;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{

    private ProductRepository $repository;
    private ProductService $service;


    public function setUP(): void
    {
        $this->repository = $this->createStub(ProductRepository::class);
        $this->service = new ProductService($this->repository);
    }

    public function testStub()
    {
        $product = new Product();
        $product->setId("1");

        $this->repository->method("findById")->willReturn($product);

        $result = $this->repository->findById("3"); // walau di stub findById("3") tapi di return product id 1

        // var_dump($result->getId()); // 1
        // var_dump($product->getId()); // 1



        $this->assertSame($product, $result);
    }

    public function testStubMap()
    {

        $product1 = new Product();
        $product1->setId("1");

        $product2 = new Product();
        $product2->setId("1");

        $this->repository->method("findById")->willReturnMap([
            ["1", $product1],
            ["2", $product2],
        ]);
        // atas kalau manggil will return map method find by id akan menghasil map

        /**
         * 
         * method("findById"):
         * Menentukan bahwa stub akan memalsukan perilaku metode findById pada objek $repository. willReturnMap
         * willReturnMap memungkinkan Anda untuk menentukan peta nilai (map) yang akan dikembalikan oleh metode berdasarkan parameter inputnya.
         *Dalam hal ini, jika metode findById dipanggil dengan parameter "1", maka akan mengembalikan $product1. Jika dipanggil dengan parameter "2", maka akan mengembalikan $product2.
         * Peta Nilai (Map):

         * ["1", $product1]: Jika findById("1") dipanggil, stub akan mengembalikan objek $product1.
         * ["2", $product2]: Jika findById("2") dipanggil, stub akan mengembalikan objek $product2.
         * Logika yang Dipalsukan:

         * Stub tidak menjalankan logika asli dari metode findById. Sebaliknya, ia hanya memeriksa parameter input dan mencocokkannya dengan peta nilai yang telah ditentukan. Jika parameter cocok, stub mengembalikan nilai yang sesuai.
         * Contoh Eksekusi:
         * Jika Anda memanggil:

         * Maka:

         * $result1 akan berisi referensi ke objek $product1.
         * $result2 akan berisi referensi ke objek $product2.
         * Namun, jika Anda memanggil:

         * Maka:

         * Stub tidak memiliki peta untuk parameter "3", sehingga akan mengembalikan null (default behavior jika tidak ada nilai yang cocok).
         * Kesimpulan:
         * Baris tersebut digunakan untuk memalsukan perilaku metode findById agar mengembalikan nilai yang berbeda berdasarkan parameter inputnya. Ini sangat berguna untuk menguji berbagai skenario tanpa bergantung pada implementasi logika asli dari metode tersebut.
         */


        $this->assertSame($product1, $this->repository->findById("1"));
        $this->assertSame($product2, $this->repository->findById("2"));

        $this->assertNotSame($product1, $this->repository->findById("2"));
    }

    public function testStubCallback()
    {

        $this->repository->method("findById")->willReturnCallback(function (string $id) {
            $product = new Product();
            $product->setId($id);
            return $product;
        });
        // atas ketika memanggil method findById, maka akan menjalankan callback function yang mengembalikan objek Product dengan ID yang diberikan.

        $product = $this->repository->findById("1");

        $this->assertSame("1", $product->getId());
        $this->assertSame("2", $this->repository->findById("2")->getId());
        $this->assertNotSame("2", $product->getId());
    }

    public function testRegisterSuccess()
    {
        $product = new Product();
        $product->setId("1");
        $product->setName("Product 1");

        $this->repository->method("findById")->willReturn(null);
        // atas ketika memanggil findById akan mengembalikan null

        $this->repository->method("save")->willReturnArgument(0);
        // atas ketika memanggil save akan mengembalikan argumen pertama yang diterima oleh metode tersebut.
        /**
         * seperti jika dipanggil
         * $repository->save($product)
         * maka akan mengembalikan $product itu sendiri.
         */

        $result = $this->service->register($product);

        $this->assertSame($product->getId(), $result->getId());
        $this->assertSame($product->getName(), $result->getName());
    }

    public function testRegisterFailed()
    {
        $productInDb = new Product();
        $productInDb->setId("1");



        $this->repository->method("findById")->willReturn($productInDb);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Product is Already exists");


        $product = new Product();
        $product->setId("1");
        $product->setName("Product 1");

        $this->service->register($product);
        // exception dipaangil karena method findById mengembalikan $productInDb yang sudah ada di database
    }


    public function testDeleteSuccess()
    {
        $product = new Product();
        $product->setId("1");

        $this->repository->method("findById")->willReturn($product);

        $this->service->delete("1");

        $this->assertTrue(true, "Delete Success");
    }

    public function testDeleteFailed()
    {

        $this->expectException(\Exception::class);
        $this->repository->method("findById")->willReturn(null);

        $this->service->delete("1");
        // exception dipanggil karena method findById mengembalikan null
    }
}