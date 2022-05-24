<?php

namespace App\Http\Services;

use App\Http\Services\Connectors\YaDiskConnector;
use App\Http\Services\YaDiskRequests\FileDownloadRequest;
use App\Http\Services\YaDiskRequests\FolderRequest;
use App\Http\Services\YaDiskRequests\TypeRequest;
use App\Http\Services\YaDiskResponses\DownloadFile;
use App\Http\Services\YaDiskResponses\ExternalFilesCollection;
use App\Http\Services\YaDiskResponses\FilteredFilesCollection;
use App\Http\Services\YaDiskResponses\FolderFilesCollection;
use App\Models\Storage;
use App\Models\StorageCredentials;
use App\Models\TokenStorageCredentials;
use Illuminate\Support\Facades\Http;

class YaDiskStorage implements ExternalStorage
{

    public function __construct(
        public YaDiskConnector    $connector,
        public Storage            $storage,
        public CredentialsStorage $credentials
    )
    {
    }


    public function filterByType(TypeRequest $request): ExternalFilesCollection
    {
        $credentials = $this->getCredentials();
        $result = $this->connector->makeRequest($request, $credentials);
        return FilteredFilesCollection::from($result);
    }

    public function getFolderFiles(FolderRequest $request): ExternalFilesCollection
    {
        $credentials = $this->getCredentials();
        $result = $this->connector->makeRequest($request, $credentials);
        return FolderFilesCollection::from($result);
    }

    public function getFile(FileDownloadRequest $request): DownloadFile
    {
        $credentials = $this->getCredentials();
        $result = $this->connector->makeRequest($request, $credentials);
        $response = Http::get($result['href']);
        return DownloadFile::from($response);
    }

    public function getCredentials(): StorageCredentials|TokenStorageCredentials
    {
        return $this->credentials->getCredentials($this->storage,
            TokenStorageCredentials::class);
    }
}
