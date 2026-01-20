<?php

declare(strict_types=1);

namespace AppTest\Integration\A_Simple;

use App\Repository\ProductRepository;
use App\Service\DatabaseConnection;
use App\Service\ProductService;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class A_FirstTest extends TestCase
{
    private function getSUT(): ProductService
    {
        $config = require __DIR__ . '/../../../../config/database.php';

        $productRepository = new ProductRepository(DatabaseConnection::getInstance($config));

        return new ProductService($productRepository);
    }

    public static function dataProviderTestFindAllProducts(): Generator
    {
        $json = file_get_contents(__DIR__ . '/../test_data/products.json');

        yield [$json];
    }

    #[DataProvider('dataProviderTestFindAllProducts')]
    public function testFindAllProducts(string $expectedJson): void
    {
        $productService = $this->getSUT();

        $result = $productService->findAllProducts();

        $productArray = [];
        foreach ($result as $product) {
            $productArray[] = $product->toArray();
        }

        $expectedArray = json_decode($expectedJson, true);

        $this->assertSame($expectedArray, $productArray);
    }
}
