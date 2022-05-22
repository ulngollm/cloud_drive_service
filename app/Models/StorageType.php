<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StorageType extends Model
{
    const YaDiskStorageType = 1;

    use HasFactory;

    public function storage(): HasOne
    {
        return $this->hasOne(Storage::class);
    }
}
