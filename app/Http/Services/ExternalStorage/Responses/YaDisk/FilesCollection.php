<?php

namespace App\Http\Services\ExternalStorage\Responses\YaDisk;

use App\Http\Services\ExternalStorage\DTO\YaDiskFile;
use App\Http\Services\ExternalStorage\Responses\ExternalFilesCollection;
use Arhitector\Yandex\Disk\AbstractResource;
use Illuminate\Support\Collection;

class FilesCollection extends ExternalFilesCollection
{

    public static function from(Collection $data): static
    {
        $items = $data
            ->map(function (AbstractResource $item) {
                return YaDiskFile::from($item);
            });
        return new static($items);
    }
}
