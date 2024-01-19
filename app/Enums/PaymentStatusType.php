<?php

namespace App\Enums;

enum PaymentStatusType: string
{
    case CONFIRMED = 'd03507bd-252f-4961-84cd-01c94dcbcef7';
    case PENDING = '419d2e1f-d5a8-44a9-8c92-791ad8168386';
    case CANCELLED = '8fe494e3-c06d-4e3c-bd09-d1c2203184d2';
}
