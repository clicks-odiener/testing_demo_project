<?php

declare(strict_types=1);

namespace App\Entity;

use Rinvex\Country\Country;

class TaxRate
{
    private string $locale;
    private float $rate;
    private string $countryCode;

    public function __construct(string $locale, float $rate, Country $country)
    {
        $this->locale = $locale;
        $this->rate = $rate;
        $this->countryCode = $country->getIsoAlpha3();
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function setRate(float $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }
}
