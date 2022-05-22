<?php

namespace App\Http\Services\DTO;

class ExternalFile
{
    public function __construct(
        public string  $id,
        public string  $type,
        public string  $name,
        public string  $path,
        public ?string $mimeType = null,
    )
    {
    }
}
