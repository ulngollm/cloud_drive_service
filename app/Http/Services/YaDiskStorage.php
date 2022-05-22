<?php

namespace App\Http\Services;

use App\Http\Services\Connectors\YaDiskConnector;
use App\Http\Services\YaDiskRequests\FolderRequest;
use App\Models\Storage;

class YaDiskStorage implements ExternalStorage
{

    public function __construct(
        public YaDiskConnector $connector,
        public Storage         $storage
    )
    {
    }


    public function filterByType(string $type)
    {

    }

    public function getFolderFiles(FolderRequest $request)
    {
        return $this->connector->makeRequest($request, $this->storage->credentials);
    }

    public function getFile(string $path)
    {
        // TODO: Implement getFile() method.
    }
}
