<?php

namespace App\Integrations\Asaas\Tests\Entitites;

use Tests\TestCase;
use App\Integrations\Asaas\Entities\Customer;
use App\Integrations\Asaas\Entities\Address;
use App\Integrations\Asaas\Entities\CreditCard;
use App\Integrations\Asaas\Entities\Payment;

class PaymentTest extends TestCase
{
    public function testJsonSerializationWithoutCreditCard()
    {
        $customer = new Customer();
        $customer->setName('John Doe');
        $customer->setCpfCnpj('12345678901');
        $customer->setEmail('john@example.com');
        $customer->setMobilePhone('123-456-7890');

        $address = new Address();
        $address->setAddress('123 Main St');
        $address->setAddressNumber('456');
        $address->setComplement('Apt 7');
        $address->setProvince('Cityville');
        $address->setPostalCode('12345-678');

        $customer->setAddress($address);

        $payment = new Payment();
        $payment->setCustomerExternalId('external_id');
        $payment->setCustomer($customer);
        $payment->setValue(100.00);
        $payment->setDueDate('2022-01-31');
        $payment->setExternalReference('123456');
        $payment->setInstallmentCount(3);
        $payment->setInstallmentValue(33.33);
        $payment->setRemoteIp('192.168.0.1');

        $expectedJson = json_encode([
            'customerExternalId' => 'external_id',
            'customer' => [
                'name' => 'John Doe',
                'cpfCnpj' => '12345678901',
                'email' => 'john@example.com',
                'mobilePhone' => '123-456-7890',
                'address' => [
                    'address' => '123 Main St',
                    'addressNumber' => '456',
                    'complement' => 'Apt 7',
                    'province' => 'Cityville',
                    'postalCode' => '12345-678',
                ],
            ],
            'value' => 100.00,
            'dueDate' => '2022-01-31',
            'externalReference' => '123456',
            'installmentCount' => 3,
            'installmentValue' => 33.33,
            'remoteIp' => '192.168.0.1',
            'creditCard' => null,
        ]);

        $this->assertSame($expectedJson, json_encode($payment->jsonSerialize()));
    }

    public function testJsonSerializationWithCreditCard()
    {
        $customer = new Customer();
        $customer->setName('John Doe');
        $customer->setCpfCnpj('12345678901');
        $customer->setEmail('john@example.com');
        $customer->setMobilePhone('123-456-7890');

        $address = new Address();
        $address->setAddress('123 Main St');
        $address->setAddressNumber('456');
        $address->setComplement('Apt 7');
        $address->setProvince('Cityville');
        $address->setPostalCode('12345-678');

        $customer->setAddress($address);

        $creditCard = new CreditCard();
        $creditCard->setHolderName('John Doe');
        $creditCard->setNumber('1234567890123456');
        $creditCard->setExpiryMonth('12');
        $creditCard->setExpiryYear('2024');
        $creditCard->setCcv('123');

        $payment = new Payment();
        $payment->setCustomerExternalId('external_id');
        $payment->setCustomer($customer);
        $payment->setValue(100.00);
        $payment->setDueDate('2022-01-31');
        $payment->setExternalReference('123456');
        $payment->setInstallmentCount(3);
        $payment->setInstallmentValue(33.33);
        $payment->setRemoteIp('192.168.0.1');
        $payment->setCreditCard($creditCard);

        $expectedJson = json_encode([
            'customerExternalId' => 'external_id',
            'customer' => [
                'name' => 'John Doe',
                'cpfCnpj' => '12345678901',
                'email' => 'john@example.com',
                'mobilePhone' => '123-456-7890',
                'address' => [
                    'address' => '123 Main St',
                    'addressNumber' => '456',
                    'complement' => 'Apt 7',
                    'province' => 'Cityville',
                    'postalCode' => '12345-678',
                ],
            ],
            'value' => 100.00,
            'dueDate' => '2022-01-31',
            'externalReference' => '123456',
            'installmentCount' => 3,
            'installmentValue' => 33.33,
            'remoteIp' => '192.168.0.1',
            'creditCard' => [
                'holderName' => 'John Doe',
                'number' => '1234567890123456',
                'expiryMonth' => '12',
                'expiryYear' => '2024',
                'ccv' => '123',
            ],
        ]);

        $this->assertSame($expectedJson, json_encode($payment->jsonSerialize()));
    }

    public function testGettersAndSetters()
    {
        $customer = new Customer();
        $customer->setName('John Doe');
        $customer->setCpfCnpj('12345678901');
        $customer->setEmail('john@example.com');
        $customer->setMobilePhone('123-456-7890');

        $address = new Address();
        $address->setAddress('123 Main St');
        $address->setAddressNumber('456');
        $address->setComplement('Apt 7');
        $address->setProvince('Cityville');
        $address->setPostalCode('12345-678');

        $customer->setAddress($address);

        $creditCard = new CreditCard();
        $creditCard->setHolderName('John Doe');
        $creditCard->setNumber('1234567890123456');
        $creditCard->setExpiryMonth('12');
        $creditCard->setExpiryYear('2024');
        $creditCard->setCcv('123');

        $payment = new Payment();
        $payment->setCustomerExternalId('external_id');
        $payment->setCustomer($customer);
        $payment->setValue(100.00);
        $payment->setDueDate('2022-01-31');
        $payment->setExternalReference('123456');
        $payment->setInstallmentCount(3);
        $payment->setInstallmentValue(33.33);
        $payment->setRemoteIp('192.168.0.1');
        $payment->setCreditCard($creditCard);

        $this->assertEquals('external_id', $payment->getCustomerExternalId());
        $this->assertEquals($customer, $payment->getCustomer());
        $this->assertEquals(100.00, $payment->getValue());
        $this->assertEquals('2022-01-31', $payment->getDueDate());
        $this->assertEquals('123456', $payment->getExternalReference());
        $this->assertEquals(3, $payment->getInstallmentCount());
        $this->assertEquals(33.33, $payment->getInstallmentValue());
        $this->assertEquals('192.168.0.1', $payment->getRemoteIp());
        $this->assertEquals($creditCard, $payment->getCreditCard());

    }
}
