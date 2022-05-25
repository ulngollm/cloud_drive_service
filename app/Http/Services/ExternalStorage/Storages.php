<?php

namespace App\Http\Services\ExternalStorage;

use App\Http\Services\ExternalStorage\DTO\NewStorage;
use App\Http\Services\ExternalStorage\Responses\DownloadedFile;
use App\Http\Services\ExternalStorage\Responses\ExternalFilesCollection;
use App\Models\Storage;
use App\Models\StorageType;
use App\Models\User;
use Illuminate\Support\Collection;

class Storages
{
    public function __construct(
        private Router $router
    )
    {
    }

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

    public function getList(User $user): Collection
    {
        return $user->storages;
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

    public function getTypes()
    {
        return StorageType::all();
    }

    public function getFolderFiles(Storage $storage, string $path): ExternalFilesCollection
    {
        $handler = $this->router->findHandler($storage);
        return $handler->getFolderFiles($path);
    }

    public function filterByType(Storage $storage, string $type): ExternalFilesCollection
    {
        $handler = $this->router->findHandler($storage);
        return $handler->filterByType($type);
    }

    public function getFile(Storage $storage, string $path): DownloadedFile
    {
        $handler = $this->router->findHandler($storage);
        return $handler->getFile($path);
    }

}
