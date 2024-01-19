<?php

namespace App\Enums;

enum PaymentMethodType: string
{
    case CREDIT_CARD = '9fcd30ed-186d-442c-9355-e317f36f3113';
    case BOLETO = 'aa4c157a-670d-429b-b0ea-20b6ff09886b';
    case PIX = '89477f3d-1df4-4305-b79d-7857c2b37478';
}
