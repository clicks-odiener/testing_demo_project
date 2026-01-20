<?php

declare(strict_types=1);

namespace AppTest\Integration\A_Simple;

use App\Entity\TaxRate;
use App\Repository\ProductRepository;
use App\Service\DatabaseConnection;
use App\Service\ProductService;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Rinvex\Country\Country;

class B_SecondTest extends TestCase
{
    private function getSUT(): ProductService
    {
        $config = require __DIR__ . '/../../../../config/database.php';

        $productRepository = new ProductRepository(DatabaseConnection::getInstance($config));

        return new ProductService($productRepository);
    }

    public static function dataProviderTestInsertProduct(): Generator
    {
        $json = file_get_contents(__DIR__ . '/../test_data/new_products.json');

        yield [$json];
    }

    #[DataProvider('dataProviderTestInsertProduct')]
    public function testInsertProduct(string $newProductsJson): void
    {
        $productService = $this->getSUT();

        $newProductsArray = json_decode($newProductsJson, true);

        foreach ($newProductsArray as $productData) {
            $taxRate = new TaxRate(
                'de',
                $productData['tax_rate'],
                country('de'),
            );
            $productData['tax_rate'] = $taxRate;
            $id = $productService->insertProduct($productData);

            $this->assertIsNumeric($id);
            $this->assertIsInt($id);
            $this->assertGreaterThan(0, $id);
        }
    }
}
