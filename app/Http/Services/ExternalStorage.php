<?php

namespace App\Http\Services;

use App\Models\Storage;

interface ExternalStorage
{
    public function addStorage(Storage $storage);

    public function renameStorage(int $id);

    public function deleteStorage(int $id);

    public function getStoragesList();

    public function filterByType(string $type);

    public function getFolderFiles(string $path);

    public function getFile(string $path);


}
