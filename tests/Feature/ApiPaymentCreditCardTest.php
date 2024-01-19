<?php

namespace Tests\Feature;

use App\Enums\PaymentMethodType;
use Illuminate\Http\Response;

class ApiPaymentCreditCardTest extends PaymentBaseTest
{
    // Run: sail artisan test --filter=ApiPaymentCreditCardTest::test_can_create_payment --coverage-html coverage/
    public function test_can_create_payment()
    {
        $requestBody = $this->getBodyCreditCard(PaymentMethodType::CREDIT_CARD->value);

        // efetuando request
        $response = $this->post($this->endpoint, $requestBody);

        // verificando resultado da request como sucesso
        $response->assertSuccessful();
    }

    // Run: sail artisan test --filter=ApiPaymentCreditCardTest::test_can_create_payment_with_installments --coverage-html coverage/
    public function test_can_create_payment_with_installments()
    {
        $requestBody = $this->getBodyCreditCard(PaymentMethodType::CREDIT_CARD->value);
        $requestBody['payment']['installments'] = 3;

        // efetuando request
        $response = $this->post($this->endpoint, $requestBody);

        // verificando resultado da request como sucesso
        $response->assertSuccessful();
    }

    // Run: sail artisan test --filter=ApiPaymentCreditCardTest::test_can_create_payment_with_invalid_card_error --coverage-html coverage/
    public function test_can_create_payment_with_invalid_card_error()
    {
        $requestBody = $this->getBodyCreditCard(PaymentMethodType::CREDIT_CARD->value);
        $requestBody['payment']['credit_card']['number'] = '123456'; // Invalid card

        // efetuando request
        $response = $this->post($this->endpoint, $requestBody);

        // verificando resultado da request
        $response->assertServerError();
    }

    // Run: sail artisan test --filter=ApiPaymentCreditCardTest::test_can_create_payment_with_invalid_card_error --coverage-html coverage/
    public function test_can_create_payment_with_invalid_payload_error()
    {
        $requestBody = $this->getBodyCreditCard(PaymentMethodType::CREDIT_CARD->value);
        unset($requestBody['payment']['credit_card']['number']);
        unset($requestBody['payment']['credit_card']['cvv']);

        // efetuando request
        $response = $this->post($this->endpoint, $requestBody);

        // verificando resultado da request
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

}
