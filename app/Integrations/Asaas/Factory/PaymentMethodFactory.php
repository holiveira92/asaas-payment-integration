<?php

namespace App\Integrations\Asaas\Factory;

use Illuminate\Support\Facades\App;
use App\Enums\PaymentMethodType;
use App\Integrations\Asaas\Services\CreditCardService;
use App\Integrations\Asaas\Services\BoletoService;
use App\Integrations\Asaas\Services\PixService;

class PaymentMethodFactory
{
    public static function build($methodType)
    {
        return match ($methodType) {
            PaymentMethodType::CREDIT_CARD->value => App::make(CreditCardService::class),
            PaymentMethodType::BOLETO->value => App::make(BoletoService::class),
            PaymentMethodType::PIX->value => App::make(PixService::class),
            default => throw new \Exception("Invalid payment gateway type.")
        };
    }
}
