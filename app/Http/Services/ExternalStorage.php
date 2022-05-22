<?php

namespace App\Http\Services;

use App\Http\Services\YaDiskRequests\FileDownloadRequest;
use App\Http\Services\YaDiskRequests\TypeRequest;
use App\Http\Services\YaDiskResponses\DownloadFile;
use App\Models\StorageCredentials;
use App\Http\Services\YaDiskRequests\FolderRequest;
use App\Http\Services\YaDiskResponses\ExternalFilesCollection;

interface ExternalStorage
{
    public function filterByType(TypeRequest $request): ExternalFilesCollection;

    public function getFolderFiles(FolderRequest $request): ExternalFilesCollection;

    public function getFile(FileDownloadRequest $request): DownloadFile;

    public function getCredentials(): StorageCredentials;

}
