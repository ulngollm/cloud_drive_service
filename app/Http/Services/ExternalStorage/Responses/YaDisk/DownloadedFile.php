<?php

namespace App\Http\Services\ExternalStorage\Responses\YaDisk;

use Laminas\Diactoros\Stream;

class DownloadedFile extends \App\Http\Services\ExternalStorage\Responses\DownloadedFile
{
    public static function from(Stream $stream, string $contentType): static
    {
        return new static($stream, $contentType);
    }
}
