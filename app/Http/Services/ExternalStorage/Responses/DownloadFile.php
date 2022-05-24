<?php

namespace App\Http\Services\ExternalStorage\Responses;

use Illuminate\Http\Client\Response;

class DownloadFile
{
    public function __construct(
        public string $content,
        public string $contentType
    )
    {
    }

    public function getResponse(): \Illuminate\Http\Response
    {
        return response($this->content, 200, [
            'Content-Type' => $this->contentType
        ]);
    }

    public static function from(Response $response): static
    {
        return new static($response->body(), $response->header('content-type'));
    }
}
