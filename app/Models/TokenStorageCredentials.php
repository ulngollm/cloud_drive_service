<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class TokenStorageCredentials extends StorageCredentials
{
    use HasFactory;

    protected $fillable = ['token'];

}
