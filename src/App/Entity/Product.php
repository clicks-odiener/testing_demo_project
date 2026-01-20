<?php

declare(strict_types=1);

namespace App\Entity;

class Product
{
    private ?int $id = null;
    private string $name;
    private float $netPrice;
    private string $currency;
    private TaxRate $taxRate;

    public function __construct(
        string $name,
        float $netPrice,
        TaxRate $taxRate,
        string $currency = 'EUR'
    ) {
        $this->name = $name;
        $this->netPrice = $netPrice;
        $this->taxRate = $taxRate;
        $this->currency = $currency;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNetPrice(): float
    {
        return $this->netPrice;
    }

    public function getTaxRate(): TaxRate
    {
        return $this->taxRate;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
