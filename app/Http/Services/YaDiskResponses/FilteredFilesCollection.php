<?php

namespace App\Http\Services\YaDiskResponses;

use App\Http\Services\DTO\ExternalFile;
use Illuminate\Support\Arr;

class FilteredFilesCollection extends ExternalFilesCollection
{

    public static function from(array $json): static
    {
        $items = collect(Arr::get($json, 'items'))
            ->map(function ($item) {
                return new ExternalFile(
                    id: $item['resource_id'],
                    type: $item['type'],
                    name: $item['name'],
                    path: $item['path'] ?? null,
                    mimeType: $item['mime_type'] ?? null
                );
            });
        return new static($items);
    }
}
