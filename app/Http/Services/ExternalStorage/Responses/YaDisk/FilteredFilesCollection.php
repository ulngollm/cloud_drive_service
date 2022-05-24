<?php

namespace App\Http\Services\ExternalStorage\Responses\YaDisk;

use App\Http\Services\ExternalStorage\DTO\YaDiskFile;
use App\Http\Services\ExternalStorage\Responses\ExternalFilesCollection;
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
