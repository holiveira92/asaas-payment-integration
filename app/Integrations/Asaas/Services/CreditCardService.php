<?php

namespace App\Integrations\Asaas\Services;

use App\Integrations\Asaas\Entities\Payment;
use App\Integrations\Asaas\Exceptions\CreditCardException;
use App\Integrations\Asaas\Enums\StatusType;
use App\Integrations\Asaas\Enums\BillingType;
use App\Integrations\Asaas\Enums\DiscoutIncreaseType;

class CreditCardService extends AbstractHttpService
{
    protected string $endpoint = "payments";

    public function __construct()
    {
        parent::__construct();
    }

    private function fillBody(Payment $payment): array
    {
        return [
            "billingType" => BillingType::CREDIT_CARD->value,
            "discount" => [
                "value" => 0,
                "dueDateLimitDays" => 0,
                "type" => DiscoutIncreaseType::PERCENTAGE->value,
            ],
            "interest" => [
                "value" => 0 // valor em %
            ],
            "fine" => [
                "value" => 0,
                "type" => DiscoutIncreaseType::PERCENTAGE->value
            ],
            "creditCard" => [
                "holderName" => $payment->getCreditCard()->getHolderName(),
                "number" => $payment->getCreditCard()->getNumber(),
                "expiryMonth" => $payment->getCreditCard()->getExpiryMonth(),
                "expiryYear" => $payment->getCreditCard()->getExpiryYear(),
                "ccv" => $payment->getCreditCard()->getCcv(),
            ],
            "creditCardHolderInfo" => [
                "name" => $payment->getCustomer()->getName(),
                "email" => $payment->getCustomer()->getEmail(),
                "cpfCnpj" => $payment->getCustomer()->getCpfCnpj(),
                "mobilePhone" => $payment->getCustomer()->getMobilePhone(),
                "postalCode" => $payment->getCustomer()->getAddress()->getPostalCode(),
                "addressNumber" => $payment->getCustomer()->getAddress()->getAddressNumber(),
                "addressComplement" => $payment->getCustomer()->getAddress()->getComplement(),
            ],
            "customer" => $payment->getCustomerExternalId(),
            "value" => $payment->getValue(),
            "dueDate" => $payment->getDueDate(),
            "externalReference" => $payment->getExternalReference(),
            "installmentCount" => $payment->getInstallmentCount(),
            "installmentValue" => $payment->getInstallmentValue(),
            "remoteIp" => $payment->getRemoteIp(),
            "postalService" => false,
        ];
    }

    public function processPayment(Payment $payment): array
    {
        $postData = $this->fillBody($payment);
        $response = $this->post($this->endpoint, $postData);

        if (empty($response['status']) || ($response['status'] ?? "") !== StatusType::CONFIRMED->value) {
            throw new CreditCardException($response);
        }

        return $response;
    }
}
