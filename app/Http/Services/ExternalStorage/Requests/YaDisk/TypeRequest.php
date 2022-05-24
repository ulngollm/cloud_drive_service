<?php

namespace App\Http\Services\ExternalStorage\Requests\YaDisk;

use App\Http\Services\ExternalStorage\Requests\StorageHttpRequest;

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
