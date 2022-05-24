<?php

namespace App\Http\Services\ExternalStorage;

use App\Models\Storage;

class Router
{

    public function __construct(
        public array $drivers,

    )
    {
    }

    public function findHandler(Storage $storage): ExternalStorage
    {
        $driver = $storage->type->driver;
        $handler = $this->findDriverHandler($driver);
        return resolve($handler, ['storage' => $storage]);

    }

    private function findDriverHandler(string $driverName)
    {
        return $this->drivers[$driverName]['handler'];
    }
}
