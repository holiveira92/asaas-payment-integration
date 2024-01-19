<?php

namespace App\Integrations\Asaas\Exceptions;

use Exception;
use Illuminate\Support\Arr;

class CreditCardException extends Exception
{
    public function __construct(array $response)
    {
        $message = Arr::first($response['errors'] ?? null);
        parent::__construct( $message['description']
            ?? 'Transacao nao autorizada. Verifique os dados do cartão e tente novamente');
    }

    public function __toString(): string
    {
        return 'Transacao nao autorizada. Verifique os dados do cartão e tente novamente';
    }

}
