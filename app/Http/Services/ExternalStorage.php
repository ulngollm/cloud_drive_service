<?php

namespace App\Http\Services;

use App\Models\Storage;

interface ExternalStorage
{
    public function filterByType(string $type);

    public function getFolderFiles(string $path);

    public function getFile(string $path);

}
