<?php

namespace App\Integrations\Asaas\Exceptions;

use Exception;
use Illuminate\Support\Arr;

class BoletoException extends Exception
{
    public function __construct(array $response)
    {
        $message = Arr::first($response['errors'] ?? null);
        parent::__construct( $message['description']
            ?? 'Erro ao registrar o Boleto Bancário . Tente novamente mais tarde');
    }

    public function __toString(): string
    {
        return 'Erro ao registrar o Boleto Bancário . Tente novamente mais tarde';
    }

}
