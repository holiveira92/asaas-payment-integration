<?php

namespace App\Integrations\Asaas\Tests\Entitites;

use Tests\TestCase;
use App\Integrations\Asaas\Entities\Address;

class AddressTest extends TestCase
{
    // Run: sail artisan test --filter=AddressTest::testJsonSerialization --coverage-html coverage/
    public function testJsonSerialization()
    {
        $address = new Address();
        $address->setAddress('123 Main St');
        $address->setAddressNumber('456');
        $address->setComplement('Apt 7');
        $address->setProvince('Cityville');
        $address->setPostalCode('12345-678');

        $expectedJson = json_encode([
            'address' => '123 Main St',
            'addressNumber' => '456',
            'complement' => 'Apt 7',
            'province' => 'Cityville',
            'postalCode' => '12345-678',
        ]);

        $this->assertSame($expectedJson, json_encode($address));
    }

    // Run: sail artisan test --filter=AddressTest::testGettersAndSetters --coverage-html coverage/
    public function testGettersAndSetters()
    {
        $address = new Address();
        $address->setAddress('123 Main St');
        $address->setAddressNumber('456');
        $address->setComplement('Apt 7');
        $address->setProvince('Cityville');
        $address->setPostalCode('12345-678');

        $this->assertEquals('123 Main St', $address->getAddress());
        $this->assertEquals('456', $address->getAddressNumber());
        $this->assertEquals('Apt 7', $address->getComplement());
        $this->assertEquals('Cityville', $address->getProvince());
        $this->assertEquals('12345-678', $address->getPostalCode());
    }
}
