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

    public function insertProduct(array $data): int
    {
        $product = new Product(
            $data['name'],
            $data['net_price'],
            $data['tax_rate'],
            $data['currency'],
        );

        return $this->productRepository->create($product);
    }
}
