<?php

namespace App\Http\Services\ExternalStorage;

use App\Http\Services\ExternalStorage\Responses\DownloadedFile;
use App\Http\Services\ExternalStorage\Responses\ExternalFilesCollection;
use App\Models\StorageCredentials;

interface ExternalStorage
{
    public function filterByType(string $mediaType): ExternalFilesCollection;

    public function getFolderFiles(string $path): ExternalFilesCollection;

    public function getFile(string $path): DownloadedFile;

}
