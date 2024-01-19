<?php

namespace App\Integrations\Asaas\Entities;

use JsonSerializable;

class Payment implements JsonSerializable
{
    private string $customerExternalId;
    private Customer $customer;
    private float $value;
    private string $dueDate;
    private string $externalReference;
    private int $installmentCount;
    private float $installmentValue;
    private string $remoteIp;
    private ?CreditCard $creditCard = null;

    public function getCustomerExternalId(): string
    {
        return $this->customerExternalId;
    }

    public function setCustomerExternalId(string $customerExternalId): void
    {
        $this->customerExternalId = $customerExternalId;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    public function getDueDate(): string
    {
        return $this->dueDate;
    }

    public function setDueDate(string $dueDate): void
    {
        $this->dueDate = $dueDate;
    }

    public function getExternalReference(): string
    {
        return $this->externalReference;
    }

    public function setExternalReference(string $externalReference): void
    {
        $this->externalReference = $externalReference;
    }

    public function getInstallmentCount(): int
    {
        return $this->installmentCount;
    }

    public function setInstallmentCount(int $installmentCount): void
    {
        $this->installmentCount = $installmentCount;
    }

    public function getInstallmentValue(): float
    {
        return $this->installmentValue;
    }

    public function setInstallmentValue(float $installmentValue): void
    {
        $this->installmentValue = $installmentValue;
    }

    public function getRemoteIp(): string
    {
        return $this->remoteIp;
    }

    public function setRemoteIp(string $remoteIp): void
    {
        $this->remoteIp = $remoteIp;
    }

    public function getCreditCard(): ?CreditCard
    {
        return $this->creditCard;
    }

    public function setCreditCard(CreditCard $creditCard=null): void
    {
        $this->creditCard = $creditCard;
    }

    public function jsonSerialize(): array
    {
        return [
            'customerExternalId' => $this->customerExternalId,
            'customer' => $this->customer->jsonSerialize(),
            'value' => $this->value,
            'dueDate' => $this->dueDate,
            'externalReference' => $this->externalReference,
            'installmentCount' => $this->installmentCount,
            'installmentValue' => $this->installmentValue,
            'remoteIp' => $this->remoteIp,
            'creditCard' => $this->creditCard?->jsonSerialize(),
        ];
    }

}
