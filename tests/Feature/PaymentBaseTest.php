<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentBaseTest extends TestCase
{
    use DatabaseMigrations;

    public string $endpoint = 'api/payments';
    /**
     * Inicia ambiente padrão para execução dos testes
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        // desabilitando notificações e filas nos testes
        Queue::fake();
        Mail::fake();
    }

    protected function getFakeCustomer(): array
    {
        $faker = \Faker\Factory::create('pt_BR');

        return [
            "name" => $faker->firstName . ' ' .  $faker->lastName,
            "email" => Str::random(20) . "@test.com",
            "phone" => $faker->phoneNumber,
            "document" => $faker->cpf(false),
            "address" => [
                "street" => $faker->streetName,
                "number" => $faker->buildingNumber,
                "complement" => "Apto1234",
                "neighborhood" => "Centro",
                "zip_code" => "30642160",
                "city" => $faker->city,
                "state" => $faker->stateAbbr,
                "country" => "BR",
            ],
        ];
    }

    protected function getCreditCardBody(): array
    {
        $faker = \Faker\Factory::create('pt_BR');

        return [
            'holder_name' => $faker->firstName . ' ' .  $faker->lastName,
            'number' => '5521950767907848',
            'expiry_month' => '12',
            'expiry_year' => "2024",
            'cvv' => '123',
        ];
    }

    protected function getDefaultBody(string $paymentMethodId): array
    {
        $body = [
            "customer" => $this->getFakeCustomer(),
            "payment" => [
                "amount" => 100,
                "installments" => 1,
                "due_date" => Carbon::today()->format('Y-m-d'),
                "method_id" => $paymentMethodId,
            ],
        ];

        return $body;
    }

    protected function getBodyCreditCard(string $paymentMethodId): array
    {
        $body = $this->getDefaultBody($paymentMethodId);

        $body['payment']['credit_card'] = $this->getCreditCardBody();

        return $body;
    }

}
