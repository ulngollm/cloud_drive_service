<?php

namespace App\Http\Services;

use App\Models\Storage;
use Illuminate\Database\Eloquent\Model;

class CredentialsStorage
{


    public function __construct(public array $drivers)
    {
    }

    public function findCredType(string $driver): string
    {
        return $this->drivers[$driver]['credentials_type'];
    }

    public function getCredentials(Storage $storage, Model $credType): array
    {
        return $credType::firstWhere('storage_id', $storage->id);
    }

    public function addCredentials(Storage $storage, array $credentials): void
    {
        $storage->loadMissing('type');
        $driver = $storage->type->driver;
        $credType = $this->findCredType($driver);
        $newCred = new $credType;
        $newCred->fill($credentials)
            ->storage()
            ->associate($storage)
            ->save();
    }
}
