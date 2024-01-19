<?php

namespace App\Integrations\Asaas\Entities;

use JsonSerializable;

class CreditCard implements JsonSerializable
{
    private string $holderName;
    private string $number;
    private string $expiryMonth;
    private string $expiryYear;
    private string $ccv;

    public function getHolderName(): string
    {
        return $this->holderName;
    }

    public function setHolderName(string $holderName): void
    {
        $this->holderName = $holderName;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function getExpiryMonth(): string
    {
        return $this->expiryMonth;
    }

    public function setExpiryMonth(string $expiryMonth): void
    {
        $this->expiryMonth = $expiryMonth;
    }

    public function getExpiryYear(): string
    {
        return $this->expiryYear;
    }

    public function setExpiryYear(string $expiryYear): void
    {
        $this->expiryYear = $expiryYear;
    }

    public function getCcv(): string
    {
        return $this->ccv;
    }

    public function setCcv(string $ccv): void
    {
        $this->ccv = $ccv;
    }

    public function jsonSerialize(): array
    {
        return [
            'holderName' => $this->holderName,
            'number' => $this->number,
            'expiryMonth' => $this->expiryMonth,
            'expiryYear' => $this->expiryYear,
            'ccv' => $this->ccv,
        ];
    }
}
