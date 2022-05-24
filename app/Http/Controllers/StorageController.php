<?php

namespace App\Http\Controllers;

use App\Http\Services\ExternalStorage\Storages;
use App\Http\Services\ExternalStorage\DTO\NewStorage;
use App\Http\Services\ExternalStorage\Requests\YaDisk\FileDownloadRequest;
use App\Http\Services\ExternalStorage\Requests\YaDisk\FolderRequest;
use App\Http\Services\ExternalStorage\Requests\YaDisk\TypeRequest;
use App\Http\Services\ExternalStorage\Router;
use App\Models\Storage;
use App\Models\StorageType;
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

    public function getStorage(Request $request, Storage $storage)
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

    public function getFolderFiles(Request $request, Storage $storage, Router $router)
    {
        $apiRequest = FolderRequest::fromRequest($request);

        $handler = $router->findHandler($storage);
        return $handler->getFolderFiles($apiRequest)->getItems();


    }

    public function filterByType(Request $request, Storage $storage, string $type, Router $router)
    {
        $apiRequest = new TypeRequest($type);

        $handler = $router->findHandler($storage);
        return $handler->filterByType($apiRequest)->getItems();

    }


    public function getFile(Request $request, Storage $storage, Router $router)
    {
        $apiRequest = FileDownloadRequest::fromRequest($request);

        $handler = $router->findHandler($storage);
        $response = $handler->getFile($apiRequest);
        return $response->getResponse();
    }

    /**
     * Получить список всех доступных типов хранилищ
     * @param Request $request
     * @return Collection
     */
    public function getTypeList(Request $request): Collection
    {
        return $this->storages->getTypes();
    }
}
