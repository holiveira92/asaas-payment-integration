<?php

namespace App\Factory;

use Illuminate\Support\Facades\App;
use App\Enums\IntegrationsType;
use App\Integrations\Asaas\Services\AsaasService;

class PaymentGatewayFactory
{
    public static function build($gatewayType)
    {
        return match ($gatewayType) {
            IntegrationsType::ASAAS->value => App::make(AsaasService::class),
            default => throw new \Exception("Invalid payment gateway type.")
        };
    }
}
