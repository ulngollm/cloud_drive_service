<?php

namespace App\Http\Services\ExternalStorage\Responses;

abstract class DownloadedFile
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
}
