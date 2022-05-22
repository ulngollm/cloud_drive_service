<?php

namespace App\Http\Services\YaDiskResponses;

use App\Http\Services\DTO\ExternalFile;
use App\Http\Services\DTO\YaDiskFile;
use Illuminate\Support\Arr;

class FilteredFilesCollection extends ExternalFilesCollection
{

    public static function from(array $json): static
    {
        $items = collect(Arr::get($json, 'items'))
            ->map(function ($item) {
                return YaDiskFile::from($item);
            });
        return new static($items);
    }
}
