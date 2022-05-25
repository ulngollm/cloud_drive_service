<?php

namespace App\Http\Services\ExternalStorage;

use App\Http\Services\ExternalStorage\Requests\YaDisk\FileDownloadRequest;
use App\Http\Services\ExternalStorage\Requests\YaDisk\FolderRequest;
use App\Http\Services\ExternalStorage\Requests\YaDisk\TypeRequest;
use App\Http\Services\ExternalStorage\Responses\ExternalFilesCollection;
use App\Http\Services\ExternalStorage\Responses\YaDisk\DownloadedFile;
use App\Http\Services\ExternalStorage\Responses\YaDisk\FilesCollection;
use App\Models\Storage;
use App\Models\StorageCredentials;
use App\Models\TokenStorageCredentials;
use Arhitector\Yandex\Client\Stream\Factory;
use Arhitector\Yandex\Disk;
use Illuminate\Support\LazyCollection;

class YaDiskStorage implements ExternalStorage
{

    public function __construct(
        public Disk               $disk,
        public Storage            $storage,
        public CredentialsStorage $credentials,
        public Factory $streamFactory
    )
    {
    }


    public function filterByType(TypeRequest $request): ExternalFilesCollection
    {
        $credentials = $this->getCredentials();
        $this->disk->setAccessToken($credentials->token);
        $result = $this->disk->getResources()->setMediaType($request->mediaType);

        $collection = LazyCollection::make($result->getIterator())->collect();
        return FilesCollection::from($collection);
    }

    public function getFolderFiles(FolderRequest $request): ExternalFilesCollection
    {
        $credentials = $this->getCredentials();
        $this->disk->setAccessToken($credentials->token);
        $result = $this->disk->getResource($request->path)->setLimit(100);

        $collection = LazyCollection::make($result->items->getIterator())->collect();
        return FilesCollection::from($collection);
    }

    public function getFile(FileDownloadRequest $request): DownloadedFile
    {
        $credentials = $this->getCredentials();
        $this->disk->setAccessToken($credentials->token);
        $resource = $this->disk->getResource($request->path);
        $stream = $this->streamFactory->createStream();
        $resource->download($stream);

        return DownloadedFile::from($stream, $resource->mime_type);
    }

    public function getCredentials(): StorageCredentials|TokenStorageCredentials
    {
        return $this->credentials->getCredentials($this->storage,
            TokenStorageCredentials::class);
    }
}
