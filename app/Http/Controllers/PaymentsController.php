<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\PaymentService;
use App\Models\PaymentMethod;
use App\Models\Payment;

class PaymentsController extends Controller
{
    protected PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function index()
    {
        $payments = $this->paymentService->getAll();
        return Inertia::render('Payments/Index', ['payments' => $payments]);
    }

    public function showByMethod(string $methodName, Request $request)
    {
        $payments = $this->paymentService->getAllByMethod($methodName);
        return Inertia::render('Payments/Index', ['payments' => $payments]);
    }

    public function create()
    {
        return Inertia::render('Payments/Create', ['payments' => []]);
    }

    public function createByType(Request $request, string $paymentMethodSlug)
    {
        /* Criando dados iniciais fake para facilitar o teste do usuário */
        $faker = \Faker\Factory::create('pt_BR');
        $paymentMethod = PaymentMethod::where('slug', $paymentMethodSlug)->firstOrFail();
        $payments = [
            'customer_name' =>  $faker->firstName . ' ' .  $faker->lastName,
            'customer_document' => $faker->cpf(false),
            'customer_email' => Str::random(20) . "@test.com",
            'customer_phone' => $faker->phoneNumber,
            'address' => [
                'address_street' => $faker->streetName,
                'address_number' => $faker->buildingNumber,
                'address_complement' => 'Apto1234',
                'address_neighborhood' => 'Centro',
                'address_city' => $faker->city,
                'address_state' => $faker->stateAbbr,
                'address_zip_code' => "60337-670",
            ],
        ];
        /* ************************************************************************************** */

        return Inertia::render("Payments/Create{$paymentMethod->name}", compact('payments'));
    }

    public function thankYou(Payment $payment, Request $request)
    {
        return Inertia::render('Payments/ThankYou', [
            'payment' => $payment->load('customer','method')
        ]);
    }

}
