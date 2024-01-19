<?php

namespace App\Integrations\Asaas\Entities;

use JsonSerializable;

class Address implements JsonSerializable
{
    private string $address;
    private string $addressNumber;
    private string $complement;
    private string $province;
    private string $postalCode;

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getAddressNumber(): string
    {
        return $this->addressNumber;
    }

    public function setAddressNumber(string $addressNumber): void
    {
        $this->addressNumber = $addressNumber;
    }

    public function getComplement(): string
    {
        return $this->complement;
    }

    public function setComplement(string $complement): void
    {
        $this->complement = $complement;
    }

    public function getProvince(): string
    {
        return $this->province;
    }

    public function setProvince(string $province): void
    {
        $this->province = $province;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function jsonSerialize(): array
    {
        return [
            'address' => $this->address,
            'addressNumber' => $this->addressNumber,
            'complement' => $this->complement,
            'province' => $this->province,
            'postalCode' => $this->postalCode,
        ];
    }
}
