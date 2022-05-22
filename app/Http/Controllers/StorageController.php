<?php

namespace App\Http\Controllers;

use App\Http\Services\CommonStorage;
use App\Http\Services\DTO\NewStorage;
use App\Http\Services\ExternalStorageRouter;
use App\Http\Services\YaDiskRequests\FileDownloadRequest;
use App\Http\Services\YaDiskRequests\FolderRequest;
use App\Http\Services\YaDiskRequests\TypeRequest;
use App\Models\Storage;
use App\Models\User;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function __construct(
        private CommonStorage $service
    )
    {
    }

    public function getList(Request $request)
    {
        return $this->service->getList(2);
    }

    public function addStorage(Request $request)
    {
        $user = User::find(2);

        $storage = NewStorage::fromRequest($request)->userId($user->id);
        //        проверка на дубли? нет ли уже в базе такого
        return $this->service->addStorage($storage);
    }

    public function renameStorage(Request $request, Storage $storage)
    {
        $label = $request->get('label');
        return $this->service->renameStorage($storage, $label);
    }

    public function deleteStorage(Storage $storage)
    {
//        проверять права пользователя
        $this->service->deleteStorage($storage);
    }

    public function getFolderFiles(Request $request, Storage $storage, ExternalStorageRouter $router)
    {
        $apiRequest = FolderRequest::fromRequest($request);

        $handler = $router->findHandler($storage);
        return $handler->getFolderFiles($apiRequest)->getItems();


    }

    public function filterByType(Request $request, Storage $storage, string $type, ExternalStorageRouter $router)
    {
        $apiRequest = new TypeRequest($type);

        $handler = $router->findHandler($storage);
        return $handler->filterByType($apiRequest)->getItems();

    }


    public function getFile(Request $request, Storage $storage, ExternalStorageRouter $router)
    {
        $apiRequest = FileDownloadRequest::fromRequest($request);

        $handler = $router->findHandler($storage);
        $response = $handler->getFile($apiRequest);
        return response()->json($response);

    }
}
