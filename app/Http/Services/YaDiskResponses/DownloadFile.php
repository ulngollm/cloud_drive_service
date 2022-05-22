<?php

namespace App\Http\Services\YaDiskResponses;

use Illuminate\Support\Arr;

class DownloadFile
{
    public function __construct(
        public string $link
    )
    {
    }
    
    public static function from(array $json): static
    {
        return new static(Arr::get($json, 'href'));
    }
}
