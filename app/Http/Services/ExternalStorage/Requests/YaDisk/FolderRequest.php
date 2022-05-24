<?php

namespace App\Http\Services\ExternalStorage\Requests\YaDisk;

use App\Http\Services\ExternalStorage\Requests\StorageHttpRequest;
use Illuminate\Http\Request;

class FolderRequest implements StorageHttpRequest
{

    public function __construct(
        public string $path
    )
    {
    }

    public function getMethod(): string
    {
        return 'get';
    }

    public function getPath(): string
    {
        return '/disk/resources';
    }

    public function getParams(): array
    {
        return [
            'path' => $this->path
        ];
    }

    public static function fromRequest(Request $request): self
    {
        $defaultPath = '/';
        return new self($request->get('path') ?? $defaultPath);
    }
}
