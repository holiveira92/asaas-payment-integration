<?php

namespace App\Integrations\Asaas\Services;

use App\Integrations\Asaas\Entities\Address;
use App\Integrations\Asaas\Entities\CreditCard;
use App\Interfaces\PaymentGatewayInterface;
use App\Integrations\Asaas\Factory\PaymentMethodFactory;
use App\Integrations\Asaas\Entities\Customer;
use App\Integrations\Asaas\Entities\Payment;
use App\Enums\PaymentMethodType;

class AsaasService implements PaymentGatewayInterface
{
    protected CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function processPayment(array $data): array
    {
        $paymentMethod = PaymentMethodFactory::build($data['payment']['method_id']);
        $payment = $this->buildPayment($data);
        $response = $paymentMethod->processPayment($payment);
        return $response;
    }

    public function createCustomer(array $customerData): array
    {
        $customer = $this->buildCustomer($customerData);
        $response = $this->customerService->createRequest($customer);
        return $response;
    }

    private function buildCustomer(array $customerData): Customer
    {
        $customer = new Customer();
        $address = $this->buildAddress($customerData['address']);

        $customer->setName($customerData['name']);
        $customer->setEmail($customerData['email']);
        $customer->setMobilePhone($customerData['phone']);
        $customer->setCpfCnpj($customerData['document']);
        $customer->setAddress($address);

        return $customer;
    }

    private function buildAddress(array $addressData): Address
    {
        $address = new Address();
        $address->setAddress($addressData['street']);
        $address->setAddressNumber($addressData['number']);
        $address->setComplement($addressData['complement']);
        $address->setProvince($addressData['neighborhood']);
        $address->setPostalCode($addressData['zip_code']);

        return $address;
    }

    private function buildCreditCard(array $creditCardData): CreditCard
    {
        $creditCard = new CreditCard();
        $creditCard->setHolderName($creditCardData['holder_name']);
        $creditCard->setNumber($creditCardData['number']);
        $creditCard->setExpiryMonth($creditCardData['expiry_month']);
        $creditCard->setExpiryYear($creditCardData['expiry_year']);
        $creditCard->setCcv($creditCardData['cvv']);

        return $creditCard;
    }

    private function buildPayment(array $paymentData): Payment
    {
        $payment = new Payment();

        $customer = $this->buildCustomer($paymentData['customer']);
        $payment->setCustomer($customer);

        $payment->setCreditCard(null);
        $payment->setCustomerExternalId($paymentData['customer']['external_id']);
        $payment->setValue($paymentData['payment']['amount']);
        $payment->setDueDate($paymentData['payment']['due_date']);
        $payment->setExternalReference($paymentData['payment']['order_number']);
        $payment->setInstallmentCount($paymentData['payment']['installments']);
        $payment->setInstallmentValue(($paymentData['payment']['amount'] / $paymentData['payment']['installments']));
        $payment->setRemoteIp($paymentData['payment']['client_ip_address']);

        if ($paymentData['payment']['method_id'] === PaymentMethodType::CREDIT_CARD->value) {
            $creditCard = $this->buildCreditCard($paymentData['payment']['credit_card']);
            $payment->setCreditCard($creditCard);
        }

        return $payment;
    }

}

