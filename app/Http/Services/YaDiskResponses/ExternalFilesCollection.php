<?php

namespace App\Http\Services\YaDiskResponses;

use App\Http\Services\DTO\ExternalFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ExternalFilesCollection
{
    public function __construct(
        public Collection $items
    )
    {
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    public static function fromYaDiskApi(array $json): self
    {
        $items = collect(Arr::get($json, '_embedded.items'))
            ->map(function ($item) {
                return new ExternalFile(
                    id: $item['resource_id'],
                    type: $item['type'],
                    name: $item['name'],
                    path: $item['path'] ?? null,
                    mimeType: $item['mime_type'] ?? null
                );
            });
        return new self($items);
    }
}
