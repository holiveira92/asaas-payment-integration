<?php

namespace App\Interfaces;

interface PaymentGatewayInterface
{
    public function createCustomer(array $data): array;
    public function processPayment(array $data): array;
}
