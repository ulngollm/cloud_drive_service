<?php

namespace App\Http\Services\YaDiskRequests;

use Illuminate\Http\Request;

class TypeRequest implements StorageHttpRequest
{

    public function __construct(
        public string $mediaType
    )
    {
    }

    public function getPath(): string
    {
        return '/disk/resources/files';
    }

    public function getMethod(): string
    {
        return 'get';
    }

    public function getParams(): array
    {
        return [
            'media_type' => $this->mediaType
        ];
    }
}
