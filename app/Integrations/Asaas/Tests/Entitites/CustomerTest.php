<?php

namespace App\Integrations\Asaas\Tests\Entitites;

use Tests\TestCase;
use App\Integrations\Asaas\Entities\Customer;
use App\Integrations\Asaas\Entities\Address;

class CustomerTest extends TestCase
{
    public function testJsonSerialization()
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

        $expectedJson = json_encode([
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
        ]);

        $this->assertSame($expectedJson, json_encode($customer->jsonSerialize()));
    }

    public function testGettersAndSetters()
    {
        $customer = new Customer();
        $customer->setName('John Doe');
        $customer->setCpfCnpj('12345678901');
        $customer->setEmail('john@example.com');
        $customer->setMobilePhone('123-456-7890');

        $this->assertEquals('John Doe', $customer->getName());
        $this->assertEquals('12345678901', $customer->getCpfCnpj());
        $this->assertEquals('john@example.com', $customer->getEmail());
        $this->assertEquals('123-456-7890', $customer->getMobilePhone());

        $address = new Address();
        $address->setAddress('123 Main St');
        $address->setAddressNumber('456');
        $address->setComplement('Apt 7');
        $address->setProvince('Cityville');
        $address->setPostalCode('12345-678');

        $customer->setAddress($address);

        $expectedJson = json_encode([
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
        ]);

        $this->assertEquals($address, $customer->getAddress());
        $this->assertSame($expectedJson, json_encode($customer->jsonSerialize()));
    }
}
