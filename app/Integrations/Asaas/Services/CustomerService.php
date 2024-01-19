<?php

namespace App\Integrations\Asaas\Services;

use App\Integrations\Asaas\Entities\Customer;

class CustomerService extends AbstractHttpService
{
    protected string $endpoint = "customers";

    public function __construct()
    {
        parent::__construct();
    }

    public function createRequest(Customer $customer): array
    {
        $response = $this->post(
            $this->endpoint,
            [
                "name" => $customer->getName(),
                "cpfCnpj" => $customer->getCpfCnpj(),
                "email" => $customer->getEmail(),
                "mobilePhone" => $customer->getMobilePhone(),

                "address" => $customer->getAddress()->getAddress(),
                "addressNumber" => $customer->getAddress()->getAddressNumber(),
                "complement" => $customer->getAddress()->getComplement(),
                "province" => $customer->getAddress()->getProvince(),
                "postalCode" => $customer->getAddress()->getPostalCode(),

                "notificationDisabled" => false,
                "observations" => "",
            ]
        );

        return $response;
    }

}
