<?php

namespace App\Http\Services;

use App\Models\StorageCredentials;

interface ExternalStorage
{
    public function filterByType(string $type);

    public function getFolderFiles(string $path);

    public function getFile(string $path);

    public function getCredentials(): StorageCredentials;

}
