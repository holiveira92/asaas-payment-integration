<?php

namespace App\Integrations\Asaas\Services;

class AuthService
{
    private string $url;
    private string $apiToken;

    public function __construct()
    {
        $this->setCredentials();
    }

    private function setCredentials()
    {
        $this->setUrl();
        $this->setApiToken();
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(): self
    {
        $this->url = config('asaas.url');

        return $this;
    }

    public function getApiToken(): string
    {
        return $this->apiToken;
    }

    public function setApiToken(): self
    {
        $this->apiToken = config('asaas.access_token');

        return $this;
    }
}
