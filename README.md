# Sistema gerador de Pagamentos com API Asass
> Sistema gerador de Pagamentos(Cartão de Crédito, Boleto e Pix)
> Integração com API Asaas


## Requerimentos

* PHP 8.2
* Laravel 10
* Mysql 8
* Node 20
* VueJS 3


## Instalação

1 - Rodar composer
```sh
 composer install
```

2 - Configurar .env
```sh
 configure database access
 configure Assas Inegrations, inserindo as variaveis abaixo
    : ASAAS_URL="https://sandbox.asaas.com/api/v3/"
    : ASAAS_API_KEY="" // sua chave sandbox
```

3 - Execute migrations
```sh
Dentro do container docker: php artisan migrate
Com Laravel Sail: sail artisan migrate
```

## Execução Local
APP_PORT=80

Laravel Sail
```sh
 sail up -d
```

Vite
```sh
 npm run dev
```

ou 

Docker
```sh
 docker-compose up -d
```

## Mailpit - Caixa de envios por Email
```sh
 http://localhost:8025/
```

## Testes PHPUnit
```sh
 sail artisan test --coverage-html coverage/
docker container: php artisan test --coverage-html coverage/
```

