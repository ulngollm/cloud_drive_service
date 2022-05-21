<?php

namespace App\Http\Services;

use App\Models\Storage;
use App\Models\StorageType;
use Illuminate\Support\Collection;

class CommonStorage
{


    public function addStorage(array $data)
    {
//        type будет передаваться в виде строки
        $cred_type = config("storages.driver.{$data['type']}");
        $credentials = $cred_type::create([
            'token' => $data['token']
        ]);
//        проверка на дубли? нет ли уже в базе такого
        return Storage::create([
            'label' => $data['label'],
            'user_id' => $data['user_id'],
            'type_id' => StorageType::YaDiskStorageType,
            'credentials_id' => $credentials->id
        ]);
    }

    public function getList(int $userId): Collection
    {
        return Storage::where('user_id', $userId)->all();
    }

    public function renameStorage(int $id, string $name): void
    {
//        проверять права на изменение этого storage
        Storage::find($id)->update([
            'label' => 'name'
        ]);
    }

    public function deleteStorage(int $id): void
    {
        Storage::find($id)->delete();
    }
}
