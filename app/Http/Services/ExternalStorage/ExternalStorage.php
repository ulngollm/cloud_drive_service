<?php

namespace App\Http\Services\ExternalStorage;

use App\Http\Services\ExternalStorage\Requests\YaDisk\FileDownloadRequest;
use App\Http\Services\ExternalStorage\Requests\YaDisk\FolderRequest;
use App\Http\Services\ExternalStorage\Requests\YaDisk\TypeRequest;
use App\Http\Services\ExternalStorage\Responses\DownloadedFile;
use App\Http\Services\ExternalStorage\Responses\ExternalFilesCollection;
use App\Models\StorageCredentials;

interface ExternalStorage
{
    public function filterByType(TypeRequest $request): ExternalFilesCollection;

    public function getFolderFiles(FolderRequest $request): ExternalFilesCollection;

    public function getFile(FileDownloadRequest $request): DownloadedFile;

    public function getCredentials(): StorageCredentials;

}
