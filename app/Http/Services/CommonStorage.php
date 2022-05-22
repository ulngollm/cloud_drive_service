<?php

namespace App\Http\Services;

use App\Http\Services\DTO\NewStorage;
use App\Models\Storage;
use Illuminate\Support\Collection;

class CommonStorage
{

    public function addStorage(NewStorage $data)
    {
        $storage = Storage::create([
            'label' => $data->label,
            'user_id' => $data->user_id,
            'type_id' => $data->driver
        ]);
        resolve(CredentialsStorage::class)->addCredentials($storage, $data->credentials);
        return $storage;
    }

    public function getList(int $userId): Collection
    {
        return Storage::where('user_id', $userId)->get();
    }

    public function renameStorage(Storage $storage, string $label): Storage
    {
        $storage->label = $label;
        $storage->save();
        return $storage;
    }

    public function deleteStorage(Storage $storage): void
    {
        $storage->delete();
    }
}
