<?php

namespace Tests\Feature;

use App\Enums\PaymentMethodType;
use Illuminate\Http\Response;

class ApiPaymentPixTest extends PaymentBaseTest
{
    // Run: sail artisan test --filter=ApiPaymentPixTest::test_can_create_payment --coverage-html coverage/
    public function test_can_create_payment()
    {
        $requestBody = $this->getDefaultBody(PaymentMethodType::PIX->value);

        // efetuando request
        $response = $this->post($this->endpoint, $requestBody);

        // verificando resultado da request como sucesso
        $response->assertSuccessful();
    }

    // Run: sail artisan test --filter=ApiPaymentPixTest::test_can_create_payment_with_invalid_card_error --coverage-html coverage/
    public function test_can_create_payment_with_invalid_card_error()
    {
        $requestBody = $this->getDefaultBody(PaymentMethodType::PIX->value);
        $requestBody['payment']['due_date'] = '2010-01-01'; // Invalid past due date

        // efetuando request
        $response = $this->post($this->endpoint, $requestBody);

        // verificando resultado da request
        $response->assertServerError();
    }

    // Run: sail artisan test --filter=ApiPaymentPixTest::test_can_create_payment_with_invalid_card_error --coverage-html coverage/
    public function test_can_create_payment_with_invalid_payload_error()
    {
        $requestBody = $this->getDefaultBody(PaymentMethodType::PIX->value);
        unset($requestBody['payment']['amount']);

        // efetuando request
        $response = $this->post($this->endpoint, $requestBody);

        // verificando resultado da request
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

}
