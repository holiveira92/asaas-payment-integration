<?php

namespace App\Integrations\Asaas\Exceptions;

use Exception;
use Illuminate\Support\Arr;

class PixException extends Exception
{
    public function __construct()
    {
        $message = Arr::first($response['errors'] ?? null);
        parent::__construct( $message['description']
            ?? 'Erro ao gerar o PIX . Tente novamente mais tarde');
    }

    public function __toString(): string
    {
        return 'Erro ao gerar o PIX . Tente novamente mais tarde';
    }

}
