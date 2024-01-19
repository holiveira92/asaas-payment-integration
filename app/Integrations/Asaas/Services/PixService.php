<?php

namespace App\Integrations\Asaas\Services;

use App\Integrations\Asaas\Enums\BillingType;
use App\Integrations\Asaas\Exceptions\PixException;
use App\Integrations\Asaas\Entities\Payment;

class PixService extends AbstractHttpService
{
    protected string $endpoint = "payments";

    public function __construct()
    {
        parent::__construct();
    }

    private function fillBody(Payment $payment): array
    {
        return [
            "billingType" => BillingType::PIX->value,
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
            throw new PixException($response);
        }

        $responsePix = $this->get($this->endpoint . '/' . $response['id'] . '/pixQrCode');

        if (empty($responsePix['payload'])) {
            throw new PixException($response);
        }

        $response = array_merge($response, $responsePix);

        return $response;
    }
}
