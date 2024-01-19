<?php

if (!function_exists('generate_order_number')) {
    /**
     * $semente para gerar o numero de compra utilizando crc32
     */
    function generate_order_number(string $seed): string
    {
        // Definindo limite da string para order number
        $orderNumberStringLimit = 11;

        // gerando numero aleatorio baseado na semente enviada( id do cliente )
        $orderNumber = sprintf('%u', crc32($seed));

        // definindo padding complementar para totalizar o order number de tamanho fixo
        $padLengthRemain = ($orderNumberStringLimit - strlen($orderNumber));
        $padLengthRemain = ($padLengthRemain > 0) ? $padLengthRemain : 0;

        // definindo sequencia de inteiros para ser misturada randomicamente
        $randomPad = substr(str_shuffle("0123456789"), 0, $padLengthRemain);

        // gerando numero final fixado no limite da string definido
        $orderNumber = substr($orderNumber . $randomPad, 0, $orderNumberStringLimit);

        return $orderNumber;
    }
}
