<?php

namespace App\Http\Controllers;

use App\Http\Services\CommonStorage;
use App\Http\Services\DTO\NewStorage;
use App\Http\Services\YaDiskRequests\FolderRequest;
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
        return $this->service->getList(3);
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

    public function getFolderFiles(Request $request, int $id)
    {
        $path = $request->get('path');

    }

    public function filterByType(Request $request, int $id)
    {
        $type = $request->get('type');
    }


    public function getFile(Request $request, int $id)
    {
        $path = $request->get('path');

    }
}
