<?php

namespace App\Integrations\Asaas\Enums;

enum BillingType: string
{
    case CREDIT_CARD = 'CREDIT_CARD';
    case BOLETO = 'BOLETO';
    case PIX = 'PIX';
}
