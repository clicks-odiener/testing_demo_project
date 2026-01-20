<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Product;
use App\Repository\ProductRepository;

class ProductService
{
    public function __construct(
        private readonly ProductRepository $productRepository
    ) {
    }

    public function findAllProducts(): array
    {
        return $this->productRepository->findAll();
    }

    public function insertProduct(array $data): void
    {
        $product = new Product(
            $data['name'],
            $data['netPrice'],
            $data['tax_rate'],
            $data['currency'],
        );

        $this->productRepository->create($product);
    }
}
