<?php

namespace App\Http\Services\YaDiskResponses;

use App\Http\Services\DTO\YaDiskFile;
use Illuminate\Support\Arr;

class FolderFilesCollection extends ExternalFilesCollection
{
    public static function from(array $json): static
    {
        $items = collect(Arr::get($json, '_embedded.items'))
            ->map(function ($item) {
                return YaDiskFile::from($item);
            });
        return new static($items);
    }
}
