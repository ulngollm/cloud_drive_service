<?php

namespace App\Http\Controllers;

use App\Http\Services\ExternalStorage\Storages;
use App\Http\Services\ExternalStorage\DTO\NewStorage;
use App\Http\Services\ExternalStorage\Router;
use App\Models\Storage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function __construct(
        private Storages $storages
    )
    {
    }

    public function getList(Request $request)
    {
        $user = $request->user();
        return $this->storages->getList($user);
    }

    public function addStorage(Request $request)
    {
        $user = $request->user();

        $storage = NewStorage::fromRequest($request)->forUser($user);
        return $this->storages->addStorage($storage);
    }

    public function getStorage(Storage $storage)
    {
        return $storage;
    }

    public function renameStorage(Request $request, Storage $storage)
    {
        $label = $request->get('label');
        return $this->storages->renameStorage($storage, $label);
    }

    public function deleteStorage(Storage $storage)
    {
        $this->storages->deleteStorage($storage);
    }

    public function getFolderFiles(Request $request, Storage $storage)
    {
        $path = $request->get('path');
        return $this->storages->getFolderFiles($storage, $path)->getItems();
    }

    public function filterByType(Storage $storage, string $type)
    {
        return $this->storages->filterByType($storage, $type)->getItems();
    }


    public function getFile(Request $request, Storage $storage)
    {
        $path = $request->get('path');
        return $this->storages->getFile($storage, $path)->getResponse();
    }

    /**
     * Получить список всех доступных типов хранилищ
     */
    public function getTypeList(): Collection
    {
        return $this->storages->getTypes();
    }
}
