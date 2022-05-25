<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Ully\Cloudstorages\Models\Storage;
use Ully\Cloudstorages\Services\Storages;

class DemoStorageController extends Controller
{
    public function __construct(
        private Storages $storages
    )
    {
    }

    public function storages(Request $request, User $user)
    {

        return view('wrapper', [
            'page' => 'cloudstorages::storages',
            'title' => 'Хранилища',
            'storages' => $this->storages->getList($user),
            'root' => true
        ]);
    }

    public function index(Request $request, Storage $storage)
    {
        $path = $request->get('path');
        return view('wrapper', [
            'page' => 'cloudstorages::files',
            'title' => $storage->label,
            'files' => $this->storages->getFolderFiles($storage, $path)->getItems()
        ]);
    }
}
