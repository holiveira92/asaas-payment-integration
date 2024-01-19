<?php

namespace App\Integrations\Asaas\Enums;

enum StatusType: string
{
    case CONFIRMED = 'CONFIRMED';
    case PENDING = 'PENDING';
    case CANCELLED = 'CANCELLED';
}
