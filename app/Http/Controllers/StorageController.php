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

    public function renameStorage(Request $request, int $id)
    {
        $label = $request->get('label');
        return $this->service->renameStorage($id, $label);
    }

    public function deleteStorage(int $id)
    {
//        проверять права пользователя
        $this->service->deleteStorage($id);
    }

    public function getFolderFiles(Request $request, int $id, ExternalStorageRouter $router)
    {
        $apiRequest = FolderRequest::fromRequest($request);
        $storage = Storage::find($id);

        $handler = $router->findHandler($storage);
        return $handler->getFolderFiles($apiRequest)->getItems();


    }

    public function filterByType(Request $request, int $id, string $type, ExternalStorageRouter $router)
    {
        $apiRequest = new TypeRequest($type);
        $storage = Storage::find($id);

        $handler = $router->findHandler($storage);
        return $handler->filterByType($apiRequest)->getItems();

    }


    public function getFile(Request $request, int $id, ExternalStorageRouter $router)
    {
        $apiRequest = FileDownloadRequest::fromRequest($request);
        $storage = Storage::find($id);

        $handler = $router->findHandler($storage);
        $response = $handler->getFile($apiRequest);
        return response()->json($response);

    }
}
