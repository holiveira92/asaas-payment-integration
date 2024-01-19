<?php

namespace App\Integrations\Asaas\Services;

use App\Integrations\Asaas\Enums\BillingType;
use App\Integrations\Asaas\Entities\Payment;
use App\Integrations\Asaas\Exceptions\BoletoException;

class BoletoService extends AbstractHttpService
{
    protected string $endpoint = "payments";

    public function __construct()
    {
        parent::__construct();
    }

    private function fillBody(Payment $payment): array
    {
        return [
            "billingType" => BillingType::BOLETO->value,
            "customer" => $payment->getCustomerExternalId(),
            "value" => $payment->getValue(),
            "dueDate" => $payment->getDueDate(),
            "externalReference" => $payment->getExternalReference(),
            "remoteIp" => $payment->getRemoteIp(),
            "postalService" => false,
        ];
    }

    public function processPayment(Payment $payment): array
    {
        $postData = $this->fillBody($payment);
        $response = $this->post($this->endpoint, $postData);

        if (empty($response['id'])) {
            throw new BoletoException($response);
        }

        return $response;
    }
}
