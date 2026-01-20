<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Product;
use App\Entity\TaxRate;
use App\Service\DatabaseConnection;
use PDO;
use ReflectionClass;

class ProductRepository
{
    private PDO $pdo;

    public function __construct(DatabaseConnection $databaseConnection)
    {
        $this->pdo = $databaseConnection->getConnection();
    }

    public function create(Product $product): int
    {
        $sql = "INSERT INTO products (name, net_price, currency, tax_rate_locale, tax_rate_rate, tax_rate_country_code)
                VALUES (:name, :net_price, :currency, :tax_rate_locale, :tax_rate_rate, :tax_rate_country_code)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $product->getName(),
            ':net_price' => $product->getNetPrice(),
            ':currency' => $product->getCurrency(),
            ':tax_rate_locale' => $product->getTaxRate()->getLocale(),
            ':tax_rate_rate' => $product->getTaxRate()->getRate(),
            ':tax_rate_country_code' => $product->getTaxRate()->getCountry()->getIsoAlpha3(),
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function findById(int $id): ?Product
    {
        $sql = "SELECT * FROM products WHERE id = :id LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch();

        if ($row === false) {
            return null;
        }

        return $this->hydrateProduct($row);
    }

    public function findAll(): array
    {
        $sql = "SELECT * FROM products ORDER BY id ASC";

        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll();

        $products = [];
        foreach ($rows as $row) {
            $products[] = $this->hydrateProduct($row);
        }

        return $products;
    }

    public function update(int $id, Product $product): bool
    {
        $sql = "UPDATE products
                SET name = :name,
                    net_price = :net_price,
                    currency = :currency,
                    tax_rate_locale = :tax_rate_locale,
                    tax_rate_rate = :tax_rate_rate,
                    tax_rate_country_code = :tax_rate_country_code
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute([
            ':id' => $id,
            ':name' => $product->getName(),
            ':net_price' => $product->getNetPrice(),
            ':currency' => $product->getCurrency(),
            ':tax_rate_locale' => $product->getTaxRate()->getLocale(),
            ':tax_rate_rate' => $product->getTaxRate()->getRate(),
            ':tax_rate_country_code' => $product->getTaxRate()->getCountry()->getIsoAlpha3(),
        ]);

        return $result && $stmt->rowCount() > 0;
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM products WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute([':id' => $id]);

        return $result && $stmt->rowCount() > 0;
    }

    private function hydrateProduct(array $row): Product
    {
        // Reconstruct Country from ISO Alpha-3 code
        $country = country($row['tax_rate_country_code']);

        // Create TaxRate
        $taxRate = new TaxRate(
            $row['tax_rate_locale'],
            (float) $row['tax_rate_rate'],
            $country
        );

        // Create Product
        $product = new Product(
            $row['name'],
            (float) $row['net_price'],
            $taxRate,
            $row['currency']
        );

        // Set ID via Reflection (Product properties are private)
        $reflection = new ReflectionClass($product);
        $idProperty = $reflection->getProperty('id');
        $idProperty->setAccessible(true);
        $idProperty->setValue($product, (int) $row['id']);

        return $product;
    }
}
