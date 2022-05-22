<?php

namespace App\Http\Services\ExternalStorage;

use App\Http\Services\ExternalStorage\Responses\ExternalFilesCollection;
use App\Http\Services\ExternalStorage\Responses\YaDisk\DownloadedFile;
use App\Http\Services\ExternalStorage\Responses\YaDisk\FilesCollection;
use App\Models\Storage;
use Arhitector\Yandex\Client\Stream\Factory;
use Arhitector\Yandex\Disk;
use Illuminate\Support\LazyCollection;

class YaDiskStorage implements ExternalStorage
{
    public function __construct(
        public Disk        $disk,
        public Storage     $storage,
        public Factory     $streamFactory,
        CredentialsStorage $credentialsStorage
    )
    {
        $credType = $credentialsStorage->findCredType($this->storage->type->driver);
        $credentials = $credentialsStorage->getCredentials($this->storage, $credType);
        $this->disk->setAccessToken($credentials->token);
    }


    public function filterByType(string $mediaType): ExternalFilesCollection
    {
        $result = $this->disk->getResources()->setMediaType($mediaType);

        $collection = LazyCollection::make($result->getIterator())->collect();
        return FilesCollection::from($collection);
    }

    public function getFolderFiles(string $path): ExternalFilesCollection
    {
        $result = $this->disk->getResource($path)->setLimit(100);

        $collection = LazyCollection::make($result->items->getIterator())->collect();
        return FilesCollection::from($collection);
    }

    public function getFile(string $path): DownloadedFile
    {
        $resource = $this->disk->getResource($path);
        $stream = $this->streamFactory->createStream();
        $resource->download($stream);

        return DownloadedFile::from($stream, $resource->mime_type);
    }

}
