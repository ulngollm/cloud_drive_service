<?php

namespace App\Http\Controllers;

use App\Models\Storage;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function getList(Request $request)
    {

    }

    public function addStorage(Request $request)
    {

    }

    public function renameStorage(Request $request, int $id)
    {
    }

    public function deleteStorage(int $id)
    {
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
