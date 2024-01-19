<?php

namespace App\Integrations\Asaas\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

abstract class AbstractHttpService
{
    protected AuthService $authService;

    public function __construct()
    {
        $this->authService = App::make(AuthService::class);
    }

    private function getAuthHeaders(): array
    {
        return ['access_token' => $this->authService->getApiToken()];
    }

    private function formatResponse(Response $response): array
    {
        return $response->json() ?? [];
    }

    protected function post(string $endpoint, array $postData): array
    {
        $response = Http::withHeaders($this->getAuthHeaders())
            ->post(
                $this->authService->getUrl() . $endpoint,
                $postData
            );

        return $this->formatResponse($response);
    }

    protected function get(string $endpointResource): array
    {
        $response = Http::withHeaders($this->getAuthHeaders())
            ->get($this->authService->getUrl() . $endpointResource);

        return $this->formatResponse($response);
    }

}
