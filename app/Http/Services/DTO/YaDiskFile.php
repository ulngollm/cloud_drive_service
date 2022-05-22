<?php

namespace App\Http\Services\DTO;

use Illuminate\Support\Str;

class YaDiskFile extends ExternalFile
{
    public static function from(array $item)
    {
        return new static(
            id: $item['resource_id'],
            type: $item['type'],
            name: $item['name'],
            path: Str::of($item['path'])->remove('disk:') ?? null,//удалить disk:
            media_type: $item['media_type'] ?? null,
            mimeType: $item['mime_type'] ?? null,
            preview: $item['preview'] ?? null,
            file: $item['file'] ?? null
        );
    }
}
