<?php

namespace App\Integrations\Asaas\Entities;

class Customer
{
    private string $name;
    private string $cpfCnpj;
    private string $email;
    private string $mobilePhone;
    private Address $address;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getMobilePhone(): string
    {
        return $this->mobilePhone;
    }

    public function setMobilePhone(string $mobilePhone): void
    {
        $this->mobilePhone = $mobilePhone;
    }

    public function getCpfCnpj(): string
    {
        return $this->cpfCnpj;
    }

    public function setCpfCnpj(string $cpfCnpj): void
    {
        $this->cpfCnpj = $cpfCnpj;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'cpfCnpj' => $this->cpfCnpj,
            'email' => $this->email,
            'mobilePhone' => $this->mobilePhone,
            'address' => $this->address->jsonSerialize(),
        ];
    }
}
