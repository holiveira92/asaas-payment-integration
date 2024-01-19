<?php

namespace App\Integrations\Asaas\Tests\Entitites;

use Tests\TestCase;
use App\Integrations\Asaas\Entities\CreditCard;

class CreditCardTest extends TestCase
{
    public function testJsonSerialization()
    {
        $creditCard = new CreditCard();
        $creditCard->setHolderName('John Doe');
        $creditCard->setNumber('1234567890123456');
        $creditCard->setExpiryMonth('12');
        $creditCard->setExpiryYear('2024');
        $creditCard->setCcv('123');

        $expectedJson = json_encode([
            'holderName' => 'John Doe',
            'number' => '1234567890123456',
            'expiryMonth' => '12',
            'expiryYear' => '2024',
            'ccv' => '123',
        ]);

        $this->assertSame($expectedJson, json_encode($creditCard));
    }

    public function testGettersAndSetters()
    {
        $creditCard = new CreditCard();
        $creditCard->setHolderName('John Doe');
        $creditCard->setNumber('1234567890123456');
        $creditCard->setExpiryMonth('12');
        $creditCard->setExpiryYear('2024');
        $creditCard->setCcv('123');

        $this->assertEquals('John Doe', $creditCard->getHolderName());
        $this->assertEquals('1234567890123456', $creditCard->getNumber());
        $this->assertEquals('12', $creditCard->getExpiryMonth());
        $this->assertEquals('2024', $creditCard->getExpiryYear());
        $this->assertEquals('123', $creditCard->getCcv());
    }
}
