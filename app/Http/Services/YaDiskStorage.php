<?php

namespace App\Http\Services;

use App\Http\Services\Connectors\YaDiskConnector;
use App\Http\Services\YaDiskRequests\FolderRequest;
use App\Http\Services\YaDiskResponses\ExternalFilesCollection;
use App\Models\Storage;
use App\Models\StorageCredentials;
use App\Models\TokenStorageCredentials;

class YaDiskStorage implements ExternalStorage
{

    public function __construct(
        public YaDiskConnector    $connector,
        public Storage            $storage,
        public CredentialsStorage $credentials
    )
    {
    }


    public function filterByType(string $type)
    {

    }

    public function getFolderFiles(FolderRequest $request): ExternalFilesCollection
    {
        $credentials = $this->getCredentials();
        $result = $this->connector->makeRequest($request, $credentials);
        return ExternalFilesCollection::fromYaDiskApi($result);
    }

    public function getFile(string $path)
    {
        // TODO: Implement getFile() method.
    }

    public function getCredentials(): StorageCredentials|TokenStorageCredentials
    {
        return $this->credentials->getCredentials($this->storage,
            TokenStorageCredentials::class);
    }
}
