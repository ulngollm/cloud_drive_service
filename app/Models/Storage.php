<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Storage extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'label', 'user_id', 'type_id'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(StorageType::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
