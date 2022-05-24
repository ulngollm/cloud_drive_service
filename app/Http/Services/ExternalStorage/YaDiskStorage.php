<?php

namespace App\Http\Services\ExternalStorage;

use App\Http\Services\ExternalStorage\Connectors\YaDiskConnector;
use App\Http\Services\ExternalStorage\Requests\YaDisk\FileDownloadRequest;
use App\Http\Services\ExternalStorage\Requests\YaDisk\FolderRequest;
use App\Http\Services\ExternalStorage\Requests\YaDisk\TypeRequest;
use App\Http\Services\ExternalStorage\Responses\DownloadFile;
use App\Http\Services\ExternalStorage\Responses\ExternalFilesCollection;
use App\Http\Services\ExternalStorage\Responses\YaDisk\FilteredFilesCollection;
use App\Http\Services\ExternalStorage\Responses\YaDisk\FolderFilesCollection;
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
