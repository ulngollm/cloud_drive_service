<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StorageCredentials extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function storage(): BelongsTo
    {
        return $this->belongsTo(Storage::class);
    }
}
