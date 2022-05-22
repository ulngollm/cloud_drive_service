<?php

namespace App\Http\Services\YaDiskResponses;

use Illuminate\Support\Collection;

abstract class ExternalFilesCollection
{
    public function __construct(
        public Collection $items
    )
    {
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    abstract public static function from(array $json): static;

}
