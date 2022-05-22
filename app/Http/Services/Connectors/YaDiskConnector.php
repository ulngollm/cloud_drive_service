<?php

namespace App\Http\Services\Connectors;

use App\Http\Services\YaDiskRequests\StorageHttpRequest;
use App\Models\TokenStorageCredentials;
use Illuminate\Support\Facades\Http;

class YaDiskConnector
{
    public function __construct(
        public string $baseUrl
    )
    {
    }

    public function makeRequest(StorageHttpRequest $request, TokenStorageCredentials $credentials): array
    {
        return Http::withToken($credentials->token, 'OAuth')
            ->baseUrl($this->baseUrl)
            ->{$request->getMethod()}(
                $request->getPath(),
                $request->getParams()
            )->json();
    }

}
